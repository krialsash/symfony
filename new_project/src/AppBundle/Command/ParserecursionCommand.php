<?php

namespace AppBundle\Command;

use AppBundle\Entity\ClassRecursion;
use AppBundle\Entity\InterfaceRecursion;
use AppBundle\Entity\NamespaceRecursion;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DomCrawler\Crawler;

class ParserecursionCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:parse:recursion')
            ->setDescription('Creates a new parse API.Recursion.com.')
            ->setHelp('This command allows you parsing sites with recursion...');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getNamespaceRecursion('http://api.Symfony.com/3.2/Symfony.html', null);
    }

    public function getNamespaceRecursion(string $url, ?NamespaceRecursion $parent=null)
    {
        $em = $this->getContainer()->get('doctrine')->getManager();

        $html = file_get_contents($url);

        $crawler = new Crawler($html);

        // parsing Namespaces
        $nodeNamespaces = $crawler->filter('div.namespace-list > a');

        foreach ($nodeNamespaces as $itemNamespace) {

            $namespaceName = $itemNamespace->textContent;
            $namespaceUrl = 'http://api.Symfony.com/3.2/'.str_replace('../', '', $itemNamespace->getAttribute('href'));

            $namespaceRecursion  = new NamespaceRecursion();
            $namespaceRecursion->setName($namespaceName);
            $namespaceRecursion->setUrl($namespaceUrl);
            $namespaceRecursion->setParent($parent);

            $em->persist($namespaceRecursion);

            // parsing Classes
            $html_namespace = file_get_contents($namespaceUrl);

            $crawlerClass = new Crawler($html_namespace);

            $nodeClasses = $crawlerClass->filter(
                'div#page-content > div.container-fluid.underlined > div.row > div.col-md-6 > a');

            foreach ($nodeClasses as $itemClass) {

                $className = $itemClass->textContent;
                $classUrl = 'http://api.Symfony.com/3.2/'.str_replace('../', '', $itemClass->getAttribute('href'));

                $classRecursion  = new ClassRecursion();
                $classRecursion->setName($className);
                $classRecursion->setUrl($classUrl);
                $classRecursion->setNamespace($namespaceRecursion);
                
                $em->persist($classRecursion);
            }
            
            // parsing Interfaces
            $crawlerInterface = new Crawler($html_namespace);
            
            $nodeInterfaces = $crawlerInterface->filter(
                'div#page-content > div.container-fluid.underlined > div.row > div.col-md-6 > em > a');
            
            foreach ($nodeInterfaces as $itemInterface) {

                $interfaceName = $itemInterface->textContent;
                $interfaceUrl = 'http://api.Symfony.com/3.2/'.str_replace('../', '', $itemInterface->getAttribute('href'));

                $interfaceRecursion  = new InterfaceRecursion();
                $interfaceRecursion->setName($interfaceName);
                $interfaceRecursion->setUrl($interfaceUrl);
                $interfaceRecursion->setNamespace($namespaceRecursion);
            
                $em->persist($interfaceRecursion);
            }
            
            $this->getNamespaceRecursion($namespaceUrl, $namespaceRecursion);

            $em->flush();
        }
    }
}

<?php

namespace AppBundle\Command;

use AppBundle\Entity\ClassSymfony;
use AppBundle\Entity\InterfaceSymfony;
use AppBundle\Entity\NamespaceSymfony;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DomCrawler\Crawler;

class ParseCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:parse')
            ->setDescription('Creates a new parse API.symfony.com.')
            ->setHelp('This command allows you parsing sites...');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $html = file_get_contents('http://api.symfony.com/3.2/');
        // var_dump($html);

        $crawler = new Crawler($html);

        // Namespace
        $rowNamespace = $crawler->filter('div.namespace-container > ul > li > a');
        // var_dump($rows->count());

        $em = $this->getContainer()->get('doctrine')->getManager();

        foreach ($rowNamespace as $item) {
            $url = 'http://api.symfony.com/3.2/' . $item->getAttribute('href');

            // var_dump($item->nodeName);
            // var_dump($item->textContent);
            // var_dump($url);

            $namespaceUrl = $item->getAttribute("href");
            $namespaceName = $item->textContent;

            $namespace = new NamespaceSymfony();
            $namespace->setUrl($namespaceUrl);
            $namespace->setName($namespaceName);

            $em->persist($namespace);

            // Class
            $htmlNamespaceForClass = file_get_contents('http://api.symfony.com/3.2/' . $namespaceUrl);
            $CrawlerNamespace = new Crawler($htmlNamespaceForClass);

            $forClass = $CrawlerNamespace->filter
            ('div#page-content > div.container-fluid.underlined > div.row > div.col-md-6 > a');

            foreach ($forClass as $item) {

                $classUrl = $item->getAttribute("href");
                $className = $item->textContent;

                $class = new ClassSymfony();
                $class->setUrl($classUrl);
                $class->setName($className);
                $class->setNamespace($namespace);

                $em->persist($class);
            }

            //Interface
            $htmlNamespaceForInt = file_get_contents('http://api.symfony.com/3.2/' . $namespaceUrl);
            $CrawlerInterface = new Crawler($htmlNamespaceForInt);

            $forInterface = $CrawlerInterface->filter
            ('div.container-fluid.underlined > div.row > div.col-md-6 > em > a');

            foreach ($forInterface as $item) {

                $interfaceUrl = $item->getAttribute("href");
                $interfaceName = $item->textContent;

                $interface = new InterfaceSymfony();
                $interface->setUrl($interfaceUrl);
                $interface->setName($interfaceName);
                $interface->setNamespace($namespace);

                $em->persist($interface);
            }
        }
    $em->flush();
    }
}

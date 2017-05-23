<?php

namespace AppBundle\Command;

use \Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DomCrawler\Crawler;

class ParseCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('app:parse')

            ->setDescription('Creates a new parse API.symfony.com.')

            ->setHelp('This command allows you parsing sites...');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $html = file_get_contents('http://api.symfony.com/3.2/');
        // var_dump($html);

        $crawler = new Crawler($html);

        $rowNamespaces = $crawler->filter('div.namespace-container > ul > li > a');
        // var_dump($rows->count());

        foreach ($rowNamespaces as $item)
        {
            $url = 'http://api.symfony.com/3.2/'.$item->getAttribute('href');

            var_dump($item->nodeName);
            var_dump($item->textContent);
            var_dump($url);

            $urlNamespace = file_get_contents($url);

            $crawlerClass= new Crawler($urlNamespace);

            $rowClasses = $crawlerClass->filter(
                'div#page-content > div.container-fluid.underlined > div.row > div.col-md-6 > a');

            foreach($rowClasses as $itemClass) {

                var_dump($itemClass->nodeName);
                var_dump($itemClass->textContent);
                var_dump($itemClass->getAttribute('href'));
            }

            $crawlerInterface = new Crawler($urlNamespace);

            $rowInterfaces = $crawlerInterface->filter(
                'div#page-content > div.container-fluid.underlined > div.row > div.col-md-6 > em > a');

            foreach($rowInterfaces as $itemInterface) {

                var_dump($itemInterface->nodeName);
                var_dump($itemInterface->textContent);
                var_dump($itemInterface->getAttribute('href'));
            }


        }
    }
}
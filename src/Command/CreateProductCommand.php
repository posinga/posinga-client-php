<?php

namespace Posinga\Client\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Posinga\Client\Client;
use Symfony\Component\Yaml\Parser as YamlParser;
use Posinga\Client\Model\Product;
use Posinga\Client\Model\ProductModel;

class CreateProductCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('product:create')
            ->setDescription('Create a product')
            ->addOption(
                'code',
                null,
                InputOption::VALUE_REQUIRED,
                'Product code'
            )
            ->addOption(
                'name',
                null,
                InputOption::VALUE_REQUIRED,
                'Product name'
            )
            ->addOption(
                'vatid',
                null,
                InputOption::VALUE_REQUIRED,
                'VAT id'
            )
            ->addOption(
                'price',
                null,
                InputOption::VALUE_REQUIRED,
                'Product price'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $code = $input->getOption('code');
        $name = $input->getOption('name');
        $vatId = $input->getOption('vatid');
        $price = $input->getOption('price');

        $product = new Product();
        $product->setCode($code)
            ->setName($name)
            ->setVatId($vatId)
            ->setPrice($price);

        $client = new Client();
        $res = $client->createProduct($product);

        if ($res === false) {
            $output->writeln('<error>Unknown error</error>');
        } else {
            $res = json_decode($res, true);
            if ($res['success']) {
                $output->writeln('<info>'.$res['status_message'].'</info>');
                $output->writeln('<info>Product ID: '.$res['product_id'].'</info>');
                if ($res['model_id']) {
                    $output->writeln('<info>Product model ID: '.$res['model_id'].'</info>');
                }
            } else {
                $output->writeln('<error>'.$res['status_message'].'</error>');
            }
        }
    }
}

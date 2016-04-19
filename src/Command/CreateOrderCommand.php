<?php

namespace Posinga\Client\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Posinga\Client\Client;
use Symfony\Component\Yaml\Parser as YamlParser;
use Posinga\Client\Model\Order;
use Posinga\Client\Model\Address;
use Posinga\Client\Model\ProductModel;

class CreateOrderCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('order:create')
            ->setDescription('Create an order')
            ->addOption(
                'filename',
                null,
                InputOption::VALUE_REQUIRED,
                'Load data from example file'
            )
            ->addOption(
                'data',
                null,
                InputOption::VALUE_REQUIRED,
                'Order data'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($input->getOption('filename')) {
            $order = $this->loadFromExampleFile($input->getOption('filename'));
        } else {
            // $data = $input->getOption('data');
            // $data = json_decode($data);
        }

        $client = new Client();
        $res = $client->createOrder($order);

        if ($res === false) {
            $output->writeln('<error>Unknown error</error>');
        } else {
            $res = json_decode($res, true);
            if ($res['success']) {
                $output->writeln('<info>'.$res['status_message'].'</info>');
                $output->writeln('<info>Order key: '.$res['order']['key'].'</info>');
            } else {
                $output->writeln('<error>'.$res['status_message'].'</error>');
            }
        }
    }

    private function loadFromExampleFile($fileName)
    {
        $parser = new YamlParser();
        $data = $parser->parse(file_get_contents(__DIR__.'/../../example/'.$fileName.'.yml'));
        $data['debug'] = true;

        $order = new Order();
        $order->setEmail($data['email'])
            ->setCustomerKey($data['customer_key'])
            ->setPricelistKey($data['pricelist_key'])
            ->setPaymentMethodCode($data['payment_method_code'])
            ->setVatNumber($data['vat_number'])
            ->setNote($data['note']);

        foreach ($data['address'] as $type => $a) {
            $address = new Address($type);
            $address->setCompany($a['company'])
                ->setFullname($a['fullname'])
                ->setAddressLine($a['address'])
                ->setPostalCode($a['postalcode'])
                ->setCity($a['city'])
                ->setCountry($a['country']);
            $order->addAddress($address);
        }

        foreach ($data['product_model'] as $m) {
            $model = new ProductModel();
            $model->setCode($m['code'])->setQuantity($m['quantity']);
            $order->addProductModel($model);
        }

        return $order;
    }

    private function loadFromArray($array = null)
    {
        if ($array === null) {
            $array = [
                'customer_key' => '81977',
                'pricelist_key' => '99b0380f-c644-43eb-bc53-978cd30093c5',
                'payment_method_code' => 'POS-PIN',
                'email' => 'h.wang@linkorb.com',
                'vat_number' => '893764837042',
                'note' => 'This is a test order',
                'address' => [
                    'billing' => [
                        'company' => 'LinkORB',
                        'fullname' => 'Hongliang',
                        'address' => 'Kerkstraat 4a',
                        'postalcode' => '5658 BC',
                        'city' => 'Oirschot',
                    ],
                    'shipping' => [
                        'company' => 'LinkORB',
                        'fullname' => 'Hongliang',
                        'address' => 'Kerkstraat 4a',
                        'postalcode' => '5658 BC',
                        'city' => 'Oirschot',
                    ],
                ],
                'product_model' => [
                    ['code' => '3269-001', 'quantity' => 2],
                    ['code' => '3285-001', 'quantity' => 1],
                ],
            ];
        }

        return $array;
    }
}

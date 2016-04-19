<?php

require_once(__DIR__.'/../vendor/autoload.php');

use Posinga\Client\Client;
use Posinga\Client\Model\Order;
use Posinga\Client\Model\Address;
use Posinga\Client\Model\ProductModel;

// construct the order
$order = new Order();
$order->setEmail('posinga@example.com')
    // ->setCustomerKey('922b6f7e-91bf-102b-a0bc-0030482ae110')
    ->setPricelistKey('99b0380f-c644-43eb-bc53-978cd30093c5')
    ->setPaymentMethodCode('WEB')
    ->setVatNumber('1500')
    ->setNote('test order');

// set addresses
// do the same for shipping address
$address = new Address('billing');
$address->setCompany(null)
    ->setFullname('hongliang')
    ->setAddressLine('ooooo')
    ->setPostalCode('5611AA')
    ->setCity('eindhoven')
    ->setCountry('netherlands');
$order->addAddress($address);

// add product models, can be multiple models
$model = new ProductModel();
$model->setCode('1091-003')->setQuantity(1);
$order->addProductModel($model);

// create the order
$client = new Client();
$res = $client->createOrder($order);

// $result is a JSON of feedback
// here is an exmpla how to parse the result
if ($res === false) {
    echo '<error>Unknown error</error>';
} else {
    $res = json_decode($res, true);
    if ($res['success']) {
        echo '<info>'.$res['status_message'].'</info>';
        echo '<info>Order key: '.$res['order']['key'].'</info>';
    } else {
        echo '<error>'.$res['status_message'].'</error>';
    }
}

<?php

namespace Posinga\Client;

// use GuzzleHttp\Post\PostFile;
use GuzzleHttp\Client as GuzzleClient;
use Symfony\Component\Yaml\Parser as YamlParser;
use Posinga\Client\Model\Order;
use Posinga\Client\Model\Product;

class Client
{
    private $parameters = null;

    public function __construct()
    {
        $this->getConfig();
    }

    private function getConfig()
    {
        if ($this->parameters === null) {
            $parser = new YamlParser();
            $this->parameters = $parser->parse(file_get_contents(__DIR__.'/../config.yml'));
        }

        return $this->parameters;
    }

    public function createOrder(Order $order)
    {
        $guzzleclient = new GuzzleClient();

        $res = $guzzleclient->post(
            ($this->parameters['api_url'].'/create'),
            [
                'auth' => [$this->parameters['username'], $this->parameters['api_key']],
                'headers' => ['content-type' => 'application/json'],
                'body' => json_encode($order->serialize(!!$this->parameters['debug'])),
            ]
        );

        $body = $res->getBody();
        if ($body) {
            return $body->read(2048);
        }

        return false;
    }

    public function createProduct(Product $product)
    {
        return $this->send('product/create', $product->serialize(!!$this->parameters['debug']));
    }

    private function send($action, $data)
    {
        $guzzleclient = new GuzzleClient();

        $params = $this->parameters['server_api'];
        $data['debug'] = !!$this->parameters['debug'];

        $res = $guzzleclient->post(
            ($params['api_url'].'/'.$action),
            [
                'auth' => [$params['username'], $params['password']],
                'headers' => ['content-type' => 'application/json'],
                'body' => json_encode($data),
            ]
        );

        if ($body = $res->getBody()) {
            return $body->read(2048);
        }

        return false;
    }
}

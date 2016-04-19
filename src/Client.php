<?php

namespace Posinga\Client;

// use GuzzleHttp\Post\PostFile;
use GuzzleHttp\Client as GuzzleClient;
use Symfony\Component\Yaml\Parser as YamlParser;
use Posinga\Client\Model\Order;

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

        // $orderData['debug'] = !!$this->parameters['debug'];

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
}

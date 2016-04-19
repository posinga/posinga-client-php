<?php

namespace Posinga\Client\Model;

class ProductModel
{
    private $code;

    public function getCode()
    {
        return $this->code;
    }

    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    private $quantity;

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = (int) $quantity;

        return $this;
    }

    public function serialize()
    {
        return [
            'code' => $this->code,
            'quantity' => $this->quantity,
        ];
    }
}

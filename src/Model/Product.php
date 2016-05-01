<?php

namespace Posinga\Client\Model;

class Product
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

    private $name;

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    private $active = 'ACTIVE';

    public function getActive()
    {
        return $this->active;
    }

    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    private $singleMultiple = 'multiple';

    public function getSingleMultiple()
    {
        return $this->singleMultiple;
    }

    public function setSingleMultiple($singleMultiple)
    {
        $this->singleMultiple = $singleMultiple;

        return $this;
    }

    private $pricePer = 'product';

    public function getPricePer()
    {
        return $this->pricePer;
    }

    public function setPricePer($pricePer)
    {
        $this->pricePer = $pricePer;

        return $this;
    }

    private $vatId;

    public function getVatId()
    {
        return $this->vatId;
    }

    public function setVatId($vatId)
    {
        $this->vatId = $vatId;

        return $this;
    }

    private $turnoverGroupId;

    public function getTurnoverGroupId()
    {
        return $this->turnoverGroupId;
    }

    public function setTurnoverGroupId($turnoverGroupId)
    {
        $this->turnoverGroupId = $turnoverGroupId;

        return $this;
    }

    public function serialize()
    {
        return get_object_vars($this);
    }

    private $price;

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }
}

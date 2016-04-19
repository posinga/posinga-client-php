<?php

namespace Posinga\Client\Model;

use Posinga\Client\Model\Address;
use Posinga\Client\Model\ProductModel;

class Order
{
    private $customerKey;

    public function getCustomerKey()
    {
        return $this->customerKey;
    }

    public function setCustomerKey($customerKey)
    {
        $this->customerKey = $customerKey;

        return $this;
    }

    private $email;

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    private $prielistKey;

    public function getPricelistKey()
    {
        return $this->prielistKey;
    }

    public function setPricelistKey($prielistKey)
    {
        $this->prielistKey = $prielistKey;

        return $this;
    }

    private $vatNumber;

    public function getVatNumber()
    {
        return $this->vatNumber;
    }

    public function setVatNumber($vatNumber)
    {
        $this->vatNumber = $vatNumber;

        return $this;
    }

    private $paymentMethodCode;

    public function getPaymentMethodCode()
    {
        return $this->paymentMethodCode;
    }

    public function setPaymentMethodCode($paymentMethodCode)
    {
        $this->paymentMethodCode = $paymentMethodCode;

        return $this;
    }

    private $note;

    public function getNote()
    {
        return $this->note;
    }

    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    private $addresses = [];

    public function addAddress(Address $address)
    {
        $this->addresses []= $address;

        return $this;
    }

    private $productModels = [];

    public function addProductModel(ProductModel $model)
    {
        $this->productModels []= $model;

        return $this;
    }

    public function serialize($debug = false)
    {
        foreach ($this->addresses as $address) {
            $addresses[$address->getType()] = $address->serialize();
        }

        foreach ($this->productModels as $model) {
            $models []= $model->serialize();
        }

        return [
            'debug' => !!$debug,
            'customer_key' => $this->customerKey,
            'pricelist_key' => $this->prielistKey,
            'payment_method_code' => $this->paymentMethodCode,
            'email' => $this->email,
            'vat_number' => $this->vatNumber,
            'note' => $this->note,
            'address' => $addresses,
            'product_model' => $models,
        ];
    }
}

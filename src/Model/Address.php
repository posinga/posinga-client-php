<?php

namespace Posinga\Client\Model;

class Address
{
    public function __construct($type = null)
    {
        if ($type) {
            $this->type = $type;
        }
    }

    private $type;

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    private $company;

    public function getCompany()
    {
        return $this->company;
    }

    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    private $fullname;

    public function getFullname()
    {
        return $this->fullname;
    }

    public function setFullname($fullname)
    {
        $this->fullname = $fullname;

        return $this;
    }

    private $addressLine;

    public function getAddressLine()
    {
        return $this->addressLine;
    }

    public function setAddressLine($addressLine)
    {
        $this->addressLine = $addressLine;

        return $this;
    }

    private $postalCode;

    public function getPostalCode()
    {
        return $this->postalCode;
    }

    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    private $city;

    public function getCity()
    {
        return $this->city;
    }

    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    private $country;

    public function getCountry()
    {
        return $this->country;
    }

    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    public function serialize()
    {
        return [
            'company' => $this->company,
            'fullname' => $this->fullname,
            'address' => $this->addressLine,
            'postalcode' => $this->postalCode,
            'city' => $this->city,
            'country' => $this->country,
        ];
    }
}

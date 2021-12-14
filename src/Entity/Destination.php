<?php

namespace App\src\Entity;

class Destination extends Entity
{
    private string $countryName;

    public function __construct(int $id, string $countryName)
    {
        parent::__construct($id);
        $this->countryName = $countryName;
    }

    public function setCountryName(string $countryName): self
    {
        $this->countryName = $countryName;

        return $this;
    }

    public function getCountryName(): string
    {
        return $this->countryName;
    }
}

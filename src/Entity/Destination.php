<?php

namespace src\Entity;

class Destination
{
    private int $id;
    private string $countryName;
    private string $conjunction;
    private string $computerName;

    public function __construct(int  $id, string $countryName, string $conjunction, string $computerName)
    {
        $this->id = $id;
        $this->countryName = $countryName;
        $this->conjunction = $conjunction;
        $this->computerName = $computerName;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
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

    public function setConjunction(string $conjunction): self
    {
        $this->conjunction = $conjunction;

        return $this;
    }

    public function getConjunction(): string
    {
        return $this->conjunction;
    }

    public function setComputerName(string $computerName): self
    {
        $this->computerName = $computerName;

        return $this;
    }

    public function getComputerName(): string
    {
        return $this->computerName;
    }
}

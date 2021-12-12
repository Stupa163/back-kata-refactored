<?php

namespace src\Entity;

class User
{
    private int $id;
    private string $firstname;

    public function __construct(int $id, string $firstname)
    {
        $this->id = $id;
        $this->firstname = $firstname;
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

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;
        return $this;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }
}

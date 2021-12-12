<?php

namespace src\Entity;

class User extends Entity
{
    private string $firstname;

    public function __construct(int $id, string $firstname)
    {
        parent::__construct($id);
        $this->firstname = $firstname;
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

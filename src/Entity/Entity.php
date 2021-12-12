<?php

namespace src\Entity;

abstract class Entity
{
    protected int $id;

    protected function __construct(int $id)
    {
        $this->id = $id;
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
}
<?php

namespace App\src\Entity;

class Site extends Entity
{
    private string $url;

    public function __construct(int $id, string $url)
    {
        parent::__construct($id);
        $this->url = $url;
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

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}

<?php

namespace App\src\Entity;

class Quote extends Entity
{
    private int $siteId;
    private int $destinationId;

    public function __construct(int $id, int $siteId, int $destinationId)
    {
        parent::__construct($id);
        $this->siteId = $siteId;
        $this->destinationId = $destinationId;
    }

    public function __toString(): string
    {
        return (string) $this->id;
    }

    public function renderHtml(): string
    {
        return '<p>' . $this->id . '</p>';
    }

    public function setSiteId(int $siteId): self
    {
        $this->siteId = $siteId;

        return $this;
    }

    public function getSiteId(): int
    {
        return $this->siteId;
    }

    public function setDestinationId(int $destinationId): self
    {
        $this->destinationId = $destinationId;

        return $this;
    }

    public function getDestinationId(): int
    {
        return $this->destinationId;
    }
}
<?php

namespace src\Entity;

class Quote
{
    private int $id;
    private int $siteId;
    private int $destinationId;

    public function __construct(int $id, int $siteId, int $destinationId)
    {
        $this->id = $id;
        $this->siteId = $siteId;
        $this->destinationId = $destinationId;
    }

    public static function renderHtml(self $quote): string
    {
        return '<p>' . $quote->id . '</p>';
    }

    public static function renderText(self $quote): string
    {
        return (string) $quote->id;
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
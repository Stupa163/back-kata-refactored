<?php

namespace src\Entity;

class Template
{
    private int $id;
    private string $subject;
    private string $content;

    public function __construct(int $id, string $subject, string $content)
    {
        $this->id = $id;
        $this->subject = $subject;
        $this->content = $content;
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

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }
}
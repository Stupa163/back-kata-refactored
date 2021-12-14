<?php

namespace App\src\Entity;

class Template extends Entity
{
    private string $subject;
    private string $content;

    public function __construct(int $id, string $subject, string $content)
    {
        parent::__construct($id);
        $this->subject = $subject;
        $this->content = $content;
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
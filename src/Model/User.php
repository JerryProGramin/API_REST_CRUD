<?php

declare(strict_types=1);

namespace Src\Model;

class User
{
    public function __construct(
        private int $Id,
        private string $Email,
        //private string $Password,
    ) {
    }

    public function getId(): int
    {
        return $this->Id;
    }

    public function getEmail(): string
    {
        return $this->Email;
    }

    // public function getPassword(): string
    // {
    //     return $this->Password;
    // }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->Id,
            'email' => $this->Email, 
        ];
    }
}
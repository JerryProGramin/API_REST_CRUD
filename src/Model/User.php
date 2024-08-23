<?php

declare(strict_types=1);

namespace Src\Model;

class User
{
    public function __construct(
        private int $id,
        private ?string $email = null,
        private ?string $password = null,
    ) {
    }

    // public function getId(): int
    // {
    //     return $this->id;
    // }

    // public function getEmail(): ?string
    // {
    //     return $this->email;
    // }

    // public function getPassword(): ?string
    // {
    //     return $this->password;
    // }

    public function jsonSerialize(): array
    {
        $data = [
            'id' => $this->id,
        ];

        if (!empty($this->email)){
            $data['email'] = $this->email;
        }

        if (!empty($this->password)){
            $data['password'] = $this->password;
        }
        return $data;
    }
}
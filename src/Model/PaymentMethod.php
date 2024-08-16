<?php

declare(strict_types = 1);

namespace Src\Model;

class PaymentMethod
{
    public function __construct(
        private int $Id,
        private string $NameMethod,
        private string $Details,
    ){
    }

    public function getId(): int
    {
        return $this->Id;
    }

    public function getNameMethod(): string
    {
        return $this->NameMethod;
    }

    public function getDetails(): string
    {
        return $this->Details;
    }
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->Id,
            'name_method' => $this->NameMethod,  
            'details' => $this->Details,
        ];
    }
}

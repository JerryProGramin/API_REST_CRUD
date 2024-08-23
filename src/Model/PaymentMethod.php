<?php

declare(strict_types = 1);

namespace Src\Model;

class PaymentMethod
{
    public function __construct(
        private int $id,
        private ?string $name = null,
        private ?string $details = null,
    ){
    }

    // public function getId(): int
    // {
    //     return $this->id;
    // }

    // public function getNameMethod(): ?string
    // {
    //     return $this->nameMethod;
    // }

    // public function getDetails(): ?string
    // {
    //     return $this->details;
    // }
    
    public function jsonSerialize(): array
    {
        $data = [
            'id' => $this->id,
        ];

        if (!empty($this->name)){
            $data['name'] = $this->name;
        }
        
        if (!empty($this->details)){
            $data['details'] = $this->details;
        }

        return $data;
    }
}

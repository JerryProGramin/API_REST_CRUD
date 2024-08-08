<?php 
declare(strict_types=1);

namespace Src\Model;
class Suppliers {
    public function __construct(
        private int $Id,
        private string $Name,
        private string $ContactInfo,
        private int $Phone,
        private string $Email
    ){
    }

    public function getId(): int {
        return $this->Id;
    }

    public function getName(): string {
        return $this->Name;
    }

    public function getContacInfo(): string {
        return $this->ContactInfo;
    }

    public function getPhone(): int {
        return $this->Phone;
    }

    public function getEmail(): string {
        return $this->Email;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->Id,
            'name' => $this->Name,
            'contact_info' => $this->ContactInfo,
            'phone' => $this->Phone,
            'email' => $this->Email,
        ];
    }
}
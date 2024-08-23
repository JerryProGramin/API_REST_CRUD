<?php 
declare(strict_types=1);

namespace Src\Model;
class Suppliers {
    public function __construct(
        private int $id,
        private string $name,
        private ?string $contactInfo = null,
        private ?string $phone = null,
        private ?string $email = null
    ){
    }

    // public function getId(): int {
    //     return $this->Id;
    // }

    // public function getName(): string {
    //     return $this->Name;
    // }

    // public function getContacInfo(): ?string {
    //     return $this->ContactInfo;
    // }

    // public function getPhone(): ?string {
    //     return $this->Phone;
    // }

    // public function getEmail(): ?string {
    //     return $this->Email;
    // }

    public function jsonSerialize(): array
    {
        $data = [
            'id' => $this->id,
        ];
            
        if(!empty($this->name)){
            $data['name'] = $this->name;
        }

        if(!empty($this->contactInfo)){
            $data['contact_info'] = $this->contactInfo;
        }

        if(!empty($this->phone)){
            $data['phone'] = $this->phone;
        }
    
        if(!empty($this->email)){
            $data['email'] = $this->email;
        }
        return $data;
    }
}
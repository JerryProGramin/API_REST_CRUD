<?php 

declare(strict_types = 1);

namespace Src\Model;

use DateTime;
use JsonSerializable;

class Products 
{
    public function __construct(
        private int $id,
        private ?string $brand = null,
        private ?string $model = null,
        private ?string $specifications = null, 
        private ?float $price = null,
        private ?string $description = null,
        private ?DateTime $releaseDate = null,
        private ?Suppliers $supplierId = null
    ){        
    }
    
    // public function getId(): int
    // {
    //     return $this->Id;
    // }
    
    // public function getBrand(): ?string
    // {
    //     return $this->Brand;
    // }
    
    // public function getModel(): ?string
    // {
    //     return $this->Model;
    // }
    
    // public function getSpecifications(): ?string
    // {
    //     return $this->Specifications;
    // }
    
    // public function getPrice(): ?float
    // {
    //     return $this->Price;
    // }
    
    // public function getDescription(): ?string
    // {
    //     return $this->Description;
    // }
    
    // public function getReleaseDate(): ?DateTime
    // {
    //     return $this->ReleaseDate;
    // }
    
    // public function getSupplierId(): ?Suppliers
    // {
    //     return $this->SupplierId;
    // }
    
    public function jsonSerialize(): array
    {
        $data = [
            'Id' => $this->id,
        ];

        if (!empty($this->brand)){
            $data['Brand'] = $this->brand;
        }

        if (!empty($this->price)){
            $data['Price'] = $this->price;
        }

        if (!empty($this->model)){
            $data['Model'] = $this->model;
        }

        if (!empty($this->specifications)){
            $data['Specifications'] = $this->specifications;
        }

        if (!empty($this->description)) {
            $data['Description'] = $this->description;
        }

        if ($this->releaseDate !== null) {
            $data['Release_date'] = $this->releaseDate->format('Y-m-d');
        }

        if ($this->supplierId !== null) {
            $data['SupplierId'] = $this->supplierId->jsonSerialize();
        }

        return $data;
    }
}
<?php 

declare(strict_types = 1);

namespace Src\Model;

use DateTime;
use JsonSerializable;

class Laptop 
{
    public function __construct(
        private int $Id,
        private string $Brand = '',
        private string $Model = '',
        private string $Specifications = '', 
        private float $Price = 0.0,
        private string $Description = '',
        private ?DateTime $ReleaseDate = null,
        private ?Suppliers $SupplierId = null
    ){        
    }
    
    public function getId(): int
    {
        return $this->Id;
    }
    
    public function getBrand(): string
    {
        return $this->Brand;
    }
    
    public function getModel(): string
    {
        return $this->Model;
    }
    
    public function getSpecifications(): string
    {
        return $this->Specifications;
    }
    
    public function getPrice(): float
    {
        return $this->Price;
    }
    
    public function getDescription(): string
    {
        return $this->Description;
    }
    
    public function getReleaseDate(): ?DateTime
    {
        return $this->ReleaseDate;
    }
    
    public function getSupplierId(): ?Suppliers
    {
        return $this->SupplierId;
    }
    
    public function jsonSerialize(): array
    {
        $data = [
            'Id' => $this->Id,
        ];

        if (!empty($this->Brand)){
            $data['Brand'] = $this->Brand;
        }

        if (!empty($this->Price)){
            $data['Price'] = $this->Price;
        }

        if (!empty($this->Model)){
            $data['Model'] = $this->Model;
        }

        if (!empty($this->Specifications)){
            $data['Specifications'] = $this->Specifications;
        }

        if (!empty($this->Description)) {
            $data['Description'] = $this->Description;
        }

        if ($this->ReleaseDate !== null) {
            $data['Release_date'] = $this->ReleaseDate->format('Y-m-d');
        }

        if ($this->SupplierId !== null) {
            $data['SupplierId'] = $this->SupplierId->jsonSerialize();
        }

        return $data;
    }
}
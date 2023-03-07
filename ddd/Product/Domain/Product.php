<?php

namespace DDD\Product\Domain;

class Product
{
    public function __construct(
        private string $name,
        private string $description,
        private string $manufacturer,
        private string $release_date,
        private float $price,
        private ?int $id = null,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getManufacturer(): string
    {
        return $this->manufacturer;
    }

    public function getReleaseDate(): string
    {
        return $this->release_date;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function updateWithValues(array $values): void
    {
        $this->name = $values['name'];
        $this->description = $values['description'];
        $this->manufacturer = $values['manufacturer'];
        $this->release_date = $values['release_date'];
        $this->price = $values['price'];
    }
}

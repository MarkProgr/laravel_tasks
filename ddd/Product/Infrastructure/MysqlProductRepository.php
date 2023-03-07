<?php

namespace DDD\Product\Infrastructure;

use DDD\Product\Domain\Product;
use DDD\Product\Domain\ProductRepository;
use Illuminate\Support\Facades\DB;

class MysqlProductRepository implements ProductRepository
{
    public function __construct()
    {
        DB::getConnections();
    }

    public function add(Product $product)
    {
        DB::insert(
            'insert into products (name, description, manufacturer, release_date, price)
                    values (?, ?, ?, ?, ?)',
            [
                $product->getName(),
                $product->getDescription(),
                $product->getManufacturer(),
                $product->getReleaseDate(),
                $product->getPrice(),
            ]
        );

        $productId = DB::scalar('select max(id) from products');
        $product->setId($productId);
    }

    public function update(Product $product)
    {
        DB::update(
            'update products set
            name = :name,
            description = :description,
            manufacturer = :manufacturer,
            release_date = :release_date,
            price = :price
            where id = :id',
            [
                'id' => $product->getId(),
                'name' => $product->getName(),
                'description' => $product->getDescription(),
                'manufacturer' => $product->getManufacturer(),
                'release_date' => $product->getReleaseDate(),
                'price' => $product->getPrice(),
            ]
        );
    }

    public function delete(Product $product)
    {
        DB::delete(
            'delete from products where id = :id',
            ['id' => $product->getId()]
        );
    }

    public function list(): array
    {
        return DB::select(
            'select * from products'
        );
    }
}

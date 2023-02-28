<?php

namespace DDD\Product\Domain;

interface ProductRepository
{
    public function add(Product $product);

    public function update(Product $product);

    public function delete(Product $product);

    public function list();
}

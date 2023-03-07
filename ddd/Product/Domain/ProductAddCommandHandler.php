<?php

namespace DDD\Product\Domain;

class ProductAddCommandHandler
{
    public function __construct(private ProductRepository $productRepository)
    {
    }

    public function handle(Product $product): void
    {
        $this->productRepository->add($product);
    }
}

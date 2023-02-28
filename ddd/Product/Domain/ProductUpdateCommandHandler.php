<?php

namespace DDD\Product\Domain;

class ProductUpdateCommandHandler
{
    public function __construct(private ProductRepository $productRepository)
    {
    }

    public function handle(Product $product): void
    {
        $this->productRepository->update($product);
    }
}

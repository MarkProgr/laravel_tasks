<?php

namespace DDD\Product\Domain;

class ProductDeleteCommandHandler
{
    public function __construct(private ProductRepository $productRepository)
    {
    }

    public function handle(Product $product): void
    {
        $this->productRepository->delete($product);
    }
}

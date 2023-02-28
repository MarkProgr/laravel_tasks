<?php

namespace DDD\Product\Domain;

class ProductListCommandHandler
{
    public function __construct(private ProductRepository $repository)
    {
    }

    public function handle()
    {
        return $this->repository->list();
    }
}

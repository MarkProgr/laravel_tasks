<?php

namespace DDD\Product\Application;

use DDD\Product\Domain\Product;
use DDD\Product\Domain\ProductAddCommandHandler;
use DDD\Product\Domain\ProductDeleteCommandHandler;
use DDD\Product\Domain\ProductListCommandHandler;
use DDD\Product\Domain\ProductUpdateCommandHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController
{
    public function addProduct(Request $request, ProductAddCommandHandler $handler): JsonResponse
    {
        $requestProduct = $request->get('product');
        $product = new Product(
            name: $requestProduct['name'],
            description: $requestProduct['description'],
            manufacturer: $requestProduct['manufacturer'],
            release_date: $requestProduct['release_date'],
            price: $requestProduct['price'],
        );

        $handler->handle($product);

        return response()->json(
            ['data' => [
                'id' => $product->getId()
            ]]
        );
    }

    public function updateProduct(int $id, Request $request, ProductUpdateCommandHandler $handler): JsonResponse
    {
        $product = $this->getProductById($id);

        if (!$product) {
            return response()->json(
                ['message' => 'Not found'],
                404
            );
        }

        $product->updateWithValues($request->get('product'));
        $handler->handle($product);
        return response()->json(
            ['message' => 'Successfully updated'],
            200,
        );
    }

    public function deleteProduct(int $id, ProductDeleteCommandHandler $handler): JsonResponse
    {
        $product = $this->getProductById($id);

        if (!$product) {
            return response()->json(
                ['message' => 'Not found'],
                404
            );
        }

        $handler->handle($product);
        return response()->json(
            ['message' => 'Successfully deleted'],
            204
        );
    }

    public function getProductById(int $id): ?Product
    {
        $product = (array)DB::selectOne(
            'select * from products where id = ?',
            [$id]
        );

        if (!$product) {
            return null;
        }

        return new Product(
            name: $product['name'],
            description: $product['description'],
            manufacturer: $product['manufacturer'],
            release_date: $product['release_date'],
            price: $product['price'],
            id: $product['id'],
        );
    }

    public function showProducts(ProductListCommandHandler $handler): JsonResponse
    {
        return response()->json(
            ['data' => $handler->handle()]
        );
    }
}

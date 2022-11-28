<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateRequest;
use App\Http\Requests\Product\EditRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create(CreateRequest $request): ProductResource
    {
        $data = $request->validated();
        $product = new Product($data);

        $product->categories()->attach($data['categories']);
        $product->save();

        return new ProductResource($product);
    }

    public function update(Product $product, EditRequest $request): ProductResource
    {
        $data = $request->validated();
        $product->fill($data);

        $product->categories()->attach($data['categories']);
        $product->save();

        return new ProductResource($product);
    }

    public function delete(Product $product)
    {
        $product->delete();

        return response(status: 204);
    }

    public function about(Product $product): ProductResource
    {
        return new ProductResource($product);
    }

    public function list()
    {
        $products = Product::all();

        return ProductResource::collection($products);
    }

    public function filterByCategory(Request $request)
    {
        if ($request->input('categories')) {
            $product = Product::query()->whereHas('categories', function (Builder $query) use ($request) {
                $query->whereIn('categories.id',$request->input('categories'));
            })->get();

            return ProductResource::collection($product);
        }

        return response(status: 404);
    }
}

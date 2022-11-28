<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CreateRequest;
use App\Http\Requests\Category\EditRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create(CreateRequest $request): CategoryResource
    {
        $data = $request->validated();
        $category = new Category($data);

        $category->save();

        return new CategoryResource($category);
    }

    public function update(Category $category, EditRequest $request): CategoryResource
    {
        $data = $request->validated();

        $category->fill($data);
        $category->save();

        return new CategoryResource($category);
    }

    public function delete(Category $category)
    {
        $category->delete();

        return response(status: 204);
    }

    public function about(Category $category): CategoryResource
    {
        return new CategoryResource($category);
    }

    public function list()
    {
        $categories = Category::all();

        return CategoryResource::collection($categories);
    }
}

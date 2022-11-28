<?php

namespace Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase, DatabaseMigrations;

    public function createProduct()
    {
        $response = $this->postJson('/api/api/create/product',
        ['name' => 'Laptop',
            'description' => 'Work',
            'manufacturer' => 'HP',
            'release_date' => '11-09-2021',
            'price' => 3900,
            'categories' => ['Laptops']]);
//        dd($response);
        dd($response->json());
        return $response->json('data.id');
    }

    public function test_create()
    {
        $response = $this->postJson('api/api/create/product',
        ['name' => 'Laptop',
            'description' => 'Work',
            'manufacturer' => 'HP',
            'release_date' => '11-09-2021',
            'price' => 3900,
            'categories' => ['Laptops']]);

        $response
            ->assertStatus(201)
            ->assertJsonStructure(
                ['data' =>
                ['id',
                    'name',
                    'description',
                    'manufacturer',
                    'release_date',
                    'price',
                    'categories']]
            );
    }

    public function test_update()
    {
        $id = $this->createProduct();

        $response = $this->putJson('/api/api/edit/product/' . $id,
        ['name' => 'Computer',
            'description' => 'Is working',
            'manufacturer' => 'Lenovo',
            'release_date' => '12-10-2021',
            'price' => 3300,
            'categories' => ['Laptops']]);

        $response
            ->assertStatus(201)
            ->assertJsonStructure(
                ['data' =>
                ['id',
                    'name',
                    'description',
                    'manufacturer',
                    'release_date',
                    'price',
                    'categories']]
            );
    }

    public function test_delete()
    {
        $id = $this->createProduct();

        $response = $this->deleteJson('/api/api/delete/product/' . $id);

        $response->assertStatus(204);
    }

    public function test_list()
    {
        $response = $this->getJson('/api/api/list/products');

        $response
            ->assertStatus(200)
            ->assertJson(fn(AssertableJson $json) =>
                $json->has('data'));
    }

    public function test_about()
    {
        $id = $this->createProduct();

        $response = $this->getJson('/api/api/about/product/' . $id);

        $response
            ->assertStatus(200)
            ->assertJsonStructure(
                ['data' =>
                ['id',
                    'name',
                    'description',
                    'manufacturer',
                    'release_date',
                    'price',
                    'categories']]
            );
    }

    public function test_filter()
    {

    }
}

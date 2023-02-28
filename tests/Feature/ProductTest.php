<?php

namespace Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    public function createCategory()
    {
        $response = $this->postJson('/api/categories', ['name' => 'Laptop']);

        return $response->json('data.id');
    }

    public function createProduct()
    {
        $categoryId[] = $this->createCategory();

        $response = $this->postJson(
            '/api/products',
            ['product' =>
                ['name' => 'Laptop',
                'description' => 'Work',
                'manufacturer' => 'HP',
                'release_date' => '11-09-2021',
                'price' => 3900,
            'categories' => $categoryId]
            ]
        );

        return $response->json('data.id');
    }

    public function testCreate()
    {
        $categoryId[] = $this->createCategory();

        $response = $this->postJson(
            '/api/products',
            ['product' =>
                ['name' => 'Laptop',
                'description' => 'Work',
                'manufacturer' => 'HP',
                'release_date' => '11-09-2021',
                'price' => 3900,
            'categories' => $categoryId],
            ]
        );

        $response
            ->assertStatus(200)
            ->assertJsonStructure(
                ['data' => ['id']]
            );
    }

    public function testUpdate()
    {
        $id = $this->createProduct();

        $categoryId[] = $this->createCategory();

        $response = $this->putJson(
            '/api/products/' . $id,
            ['product' => [
                'name' => 'Computer',
                'description' => 'Is working',
                'manufacturer' => 'Lenovo',
                'release_date' => '12-10-2021',
                'price' => 3300,
            'categories' => $categoryId,]
            ]
        );

        $response
            ->assertStatus(200)
            ->assertJsonStructure(
                ['message']
            );
    }

    public function testDelete()
    {
        $id = $this->createProduct();

        $response = $this->deleteJson('/api/products/' . $id);

        $response->assertStatus(204);
    }

    public function testList()
    {
        $this->createProduct();
        $response = $this->getJson('/api/products');

        $response
            ->assertStatus(200)
            ->assertJsonStructure(
                (['data' => [ 0 => [
                    'id',
                    'name',
                    'description',
                    'manufacturer',
                    'release_date',
                    'price',
                    'created_at',
                    'updated_at']]
                ])
            );
    }

    public function testAbout()
    {
        $id = $this->createProduct();

        $response = $this->getJson('/api/products/' . $id);

        $response
            ->assertStatus(200)
            ->assertJsonStructure(
                ['data' => ['id',
                    'name',
                    'description',
                    'manufacturer',
                    'release_date',
                    'price',
                    'categories', ]]
            );
    }

    public function testFilter()
    {
        $this->markTestSkipped();
        $categoryResponse = $this->postJson('/api/categories', ['name' => 'Laptop']);

        $categoryName[] = $categoryResponse->json('data.name');

        $this->createProduct();
        $response = $this->postJson('/api/products/filter', ['categories' => $categoryName]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure(
                ['data' => ['0' => ['id',
                    'name',
                    'description',
                    'manufacturer',
                    'release_date',
                    'price',
                'categories',
                ]]]
            );
    }
}

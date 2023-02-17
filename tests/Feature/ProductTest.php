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
        $response = $this->postJson('/api/category/create', ['name' => 'Laptop']);

        return $response->json('data.id');
    }

    public function createProduct()
    {
        $categoryId[] = $this->createCategory();

        $response = $this->postJson(
            '/api/product/create',
            ['name' => 'Laptop',
                'description' => 'Work',
                'manufacturer' => 'HP',
                'release_date' => '11-09-2021',
                'price' => 3900,
            'categories' => $categoryId,
            ]
        );

        return $response->json('data.id');
    }

    public function testCreate()
    {
        $categoryId[] = $this->createCategory();

        $response = $this->postJson(
            '/api/product/create',
            ['name' => 'Laptop',
                'description' => 'Work',
                'manufacturer' => 'HP',
                'release_date' => '11-09-2021',
                'price' => 3900,
            'categories' => $categoryId,
            ]
        );

        $response
            ->assertStatus(201)
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

    public function testUpdate()
    {
        $id = $this->createProduct();

        $categoryId[] = $this->createCategory();

        $response = $this->putJson(
            '/api/product/' . $id,
            ['name' => 'Computer',
                'description' => 'Is working',
                'manufacturer' => 'Lenovo',
                'release_date' => '12-10-2021',
                'price' => 3300,
            'categories' => $categoryId,
            ]
        );

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

    public function testDelete()
    {
        $id = $this->createProduct();

        $response = $this->deleteJson('/api/product/' . $id);

        $response->assertStatus(204);
    }

    public function testList()
    {
        $this->createProduct();
        $response = $this->getJson('/api/product/');

        $response
            ->assertStatus(200)
            ->assertJsonStructure(
                ['data',
                    'links',
                    'meta', ]
            );
    }

    public function testAbout()
    {
        $id = $this->createProduct();

        $response = $this->getJson('/api/product/' . $id);

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
        $categoryResponse = $this->postJson('/api/category/create', ['name' => 'Laptop']);

        $categoryName[] = $categoryResponse->json('data.name');

        $this->createProduct();
        $response = $this->postJson('/api/product/filter', ['categories' => $categoryName]);

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

<?php

namespace Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    public function createCategory()
    {
        $response = $this->postJson('/api/category/create', ['name' => 'Laptop']);

        return $response->json('data.id');
    }

    public function testCreate()
    {
        $response = $this->postJson('/api/category/create', ['name' => 'Laptop']);

        $response
            ->assertStatus(201)
            ->assertJsonStructure(
                ['data' => ['id',
                'name',
                ]]
            );
    }

    public function testUpdate()
    {
        $id = $this->createCategory();

        $response = $this->putJson(
            '/api/category/' . $id,
            ['name' => 'Laptops']
        );

        $response
            ->assertStatus(200)
            ->assertJsonStructure(['data' => [
                'id',
                'name', ]]);
    }

    public function testDelete()
    {
        $id = $this->createCategory();

        $response = $this->deleteJson('/api/category/' . $id);

        $response->assertStatus(204);
    }

    public function testList()
    {
        $response = $this->getJson('/api/category/');

        $response
            ->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) => $json->has('data'));
    }

    public function testAbout()
    {
        $id = $this->createCategory();

        $response = $this->getJson('/api/category/' . $id);

        $response
            ->assertStatus(200)
            ->assertJsonStructure(['data' => [
                'id',
                'name', ]]);
    }
}

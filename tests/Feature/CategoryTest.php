<?php

namespace Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase, DatabaseMigrations;

    public function createCategory()
    {
        $response = $this->postJson('/api/api/create/category', ['name' => 'Laptops']);

        return $response->json('data.id');
    }

    public function test_create()
    {
        $response = $this->postJson('/api/api/create/category', ['name' => 'Laptops']);

        $response->assertJsonStructure(['data' => [
            'id',
            'name']]);
    }

    public function test_update()
    {
        $id = $this->createCategory();

        $response = $this->putJson('/api/api/edit/category/' . $id,
        ['name' => 'Phones']);

        $response
            ->assertStatus(201)
            ->assertJsonStructure(['data' => [
                'id',
                'name']]);
    }

    public function test_delete()
    {
        $id = $this->createCategory();

        $response = $this->deleteJson('/api/api/delete/category/' . $id);

        $response->assertStatus(204);
    }

    public function test_list()
    {
        $response = $this->getJson('/api/api/list/categories');

        $response
            ->assertStatus(200)
            ->assertJson(fn(AssertableJson $json) =>
                $json->has('data'));
    }

    public function test_about()
    {
        $id = $this->createCategory();

        $response = $this->getJson('/api/api/about/category/' . $id);

        $response
            ->assertStatus(200)
            ->assertJsonStructure(['data' => [
                'id',
                'name']]);
    }
}

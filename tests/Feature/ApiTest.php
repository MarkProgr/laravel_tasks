<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use RefreshDatabase, DatabaseMigrations;

    public function createUser()
    {
        $response = $this->postJson('/api/create',
            ['name' => 'Vasya',
                'email' => rand(0, 1000) . '@' . rand(0, 1000),
                'gender' => 'Male',
                'status' => 'Active'
            ]);

        return $response->json('data.id');
    }

    public function test_create()
    {
        $response = $this->postJson('/api/create',
            ['name' => 'Vasya',
                'email' => rand(0, 1000) . '@' . rand(0, 1000),
                'gender' => 'Male',
                'status' => 'Active'
            ]);

        $response
            ->assertStatus(201)
            ->assertJsonStructure(['data' =>[
                'id',
                'name',
                'email',
                'gender',
                'status',
                'image_name'
            ]]);
    }

    public function test_list()
    {
        $response = $this->getJson('/api/list');

        $response
            ->assertStatus(200)
            ->assertJson(fn(AssertableJson $json) =>
                $json->has('data'));
    }

    public function test_edit()
    {
        $id = $this->createUser();

        $response = $this->putJson('/api/edit/' . $id,
            ['name' => 'Volodya',
                'email' => rand(0, 1000) . '@' . rand(0, 1000),
                'gender' => 'Female',
                'status' => 'Active']);

        $response
            ->assertStatus(200)
            ->assertJsonStructure(
                ['data' =>
                    ['id',
                    'name',
                    'email',
                    'gender',
                    'status',
                    'image_name'
            ]]);
    }

    public function test_delete()
    {
        $id = $this->createUser();

        $response = $this->deleteJson('/api/delete/' . $id);

        $response->assertStatus(204);
    }

    public function test_about()
    {
        $id = $this->createUser();

        $response = $this->getJson('/api/about/' . $id);

        $response
            ->assertStatus(200)
            ->assertJsonStructure(
            ['data' =>
                ['id',
                'name',
                'email',
                'gender',
                'status',
                'image_name'
            ]]);
    }
}

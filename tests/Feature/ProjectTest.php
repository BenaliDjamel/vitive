<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTest extends TestCase
{
  // use RefreshDatabase;


    /**
     * @test
     */
    public function it_create_a_project_without_an_owner()
    {
        $response = $this->postJson(
            '/api/projects/create',
            ['name' => 'asana-cl']
        );

        $response
            ->assertStatus(200)
            ->assertExactJson([
                'id' => $response['id'],
                'name' => $response['name'],
                'dueDate' => $response['dueDate'],
                'owner' => $response['owner'],
                'members' => $response['members']
            ]);
    }

    /**
     * @test
     */
    public function it_update_project_name() {
        $id = "d1d648a1-f6ce-4988-8346-c311f3c7d7eb";

        $response = $this->putJson("/api/projects/project/{$id}", [
            'name' => 'asana-cl-updated-v2'
        ]);
        $response
            ->assertStatus(200)
            ->assertExactJson([
                'id' => $response['id'],
                'name' => $response['name'],
                'dueDate' => $response['dueDate'],
                'owner' => $response['owner'],
                'members' => $response['members']
            ]);

    }
}

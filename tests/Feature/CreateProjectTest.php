<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateProjectTest extends TestCase
{
    use RefreshDatabase;


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
}

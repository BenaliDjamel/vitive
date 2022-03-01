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
        $id = "ebee7115-6724-4179-9fd4-c3972c6c5ec7";

        $response = $this->putJson("/api/projects/{$id}", [
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

    /**
     * @test
     */
    public function it_deletes_a_project(){

        $id = "51483b32-6fc0-4186-93f7-9d1a5055ba7d";

        $response = $this->deleteJson("/api/projects/{$id}");
        $response
        ->assertStatus(200);

        $this->assertDatabaseMissing('projects', [
            'id' => $id ,
        ]);
    }
}

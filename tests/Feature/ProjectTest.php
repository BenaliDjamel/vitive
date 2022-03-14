<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTest extends TestCase
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

    /**
     * @test
     */
    public function it_update_project_name()
    {

        $project = entity('Vitive\projectManagement\domain\Project')->create();

        $response = $this->putJson("/api/projects/{$project->id()}", [
            'name' => 'asana-cl-updated'
        ]);

        $response->assertStatus(200)
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
    public function it_deletes_a_project()
    {

        $project = entity('Vitive\projectManagement\domain\Project')->create();

        $response = $this->deleteJson("/api/projects/{$project->id()}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('projects', [
            'id' => $project->id(),
        ]);
    }
}

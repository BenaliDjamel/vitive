<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;


    /**
     * @test
     */
    public function it_create_a_project_without_an_owner()
    {
        Sanctum::actingAs(
            entity('Vitive\projectManagement\domain\user\User')->create()
        );


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
        Sanctum::actingAs(
            entity('Vitive\projectManagement\domain\user\User')->create()
        );

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
        Sanctum::actingAs(
            entity('Vitive\projectManagement\domain\user\User')->create()
        );

        $project = entity('Vitive\projectManagement\domain\Project')->create();

        $response = $this->deleteJson("/api/projects/{$project->id()}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('projects', [
            'id' => $project->id(),
        ]);
    }

    /**
     * @test
     */
    public function it_add_an_owner_to_a_project()
    {
        $user = entity('Vitive\projectManagement\domain\user\User')->create();

        Sanctum::actingAs( $user);

        $project = entity('Vitive\projectManagement\domain\Project')->create();

        $response = $this->putJson("/api/projects/{$project->id()}/changeOwner" , [
            'ownerId' =>  $user->id()
        ]);

        $response->assertStatus(200)
        ->assertExactJson([
            'id' => $response['id'],
            'name' => $response['name'],
            'dueDate' => $response['dueDate'],
            'owner' => $response['owner'],
        ]);

    }
}

<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class WorkspaceTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function it_create_a_workspace()
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $response = $this->postJson('/api/workspaces', [
            'name'=> 'IT'
        ]);

        $response
        ->assertStatus(200);

        $this->assertDatabaseHas('workspaces', [
            'name' => 'IT',
        ]);
    }
}

<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
            'name' => 'IT'
        ]);

        $response
            ->assertStatus(200);

        $this->assertDatabaseHas('workspaces', [
            'name' => 'IT',
        ]);
    }

    /**
     * @test
     */
    public function it_create_workspace_with_empty_name_throws_exception()
    {

        $this->expectException(ValidationException::class);

        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $this->withoutExceptionHandling()->postJson('/api/workspaces', [
            'name' => ''
        ]);
    }
}

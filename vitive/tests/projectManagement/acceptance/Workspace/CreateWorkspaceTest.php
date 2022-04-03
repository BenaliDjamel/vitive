<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Tests\projectManagement\common\UserFactory;
use Vitive\projectManagement\application\commands\Workspace\WorkspaceRequest;
use Vitive\projectManagement\application\Workspace\CreateWorkspace;
use Vitive\projectManagement\domain\Workspace\WorkspaceRepository;
use Vitive\projectManagement\infrastructure\persistence\WorkspaceMemoryRepository;

final class CreateWorkspaceTest extends TestCase
{

    private CreateWorkspace $createWorkspace;
    private WorkspaceRepository $workspaceRepository;



    protected function setUp(): void
    {

        $this->workspaceRepository = new WorkspaceMemoryRepository();
        $this->createWorkspace = new CreateWorkspace($this->workspaceRepository);
       
    }

    /**
     * @test
     */
    public function it_create_a_workspace()
    {

        $user = UserFactory::create();

        $workspace = $this->createWorkspace->execute(new WorkspaceRequest("IT", $user->id()));

        $this->assertEquals('IT', $workspace->name);
        $this->assertEquals($user->id(), $workspace->creatorId);
    }
}

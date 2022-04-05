<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Tests\ProjectManagement\Common\UserFactory;
use Vitive\ProjectManagement\Domain\Workspace\WorkspaceRepository;
use Vitive\ProjectManagement\Application\Workspace\CreateWorkspace;
use Vitive\ProjectManagement\Application\Workspace\ChangeWorkspaceName;
use Vitive\ProjectManagement\Application\Commands\Workspace\WorkspaceRequest;
use Vitive\ProjectManagement\Infrastructure\Persistence\WorkspaceMemoryRepository;
use Vitive\ProjectManagement\Application\Commands\Workspace\ChangeWorkspaceNameRequest;

final class ChangeWorkspaceNameTest extends TestCase
{

    private ChangeWorkspaceName $changeWorkspaceName;
    private WorkspaceRepository $workspaceRepository;
    private CreateWorkspace $createWorkspace;
    private $workspace;

    protected function setUp(): void
    {
        $this->workspaceRepository = new WorkspaceMemoryRepository();
        $this->createWorkspace = new CreateWorkspace($this->workspaceRepository);
        $this->workspace = $this->createWorkspace->execute(
            new WorkspaceRequest("IT", "55e42502-79ee-47ac-b085-4571fc0f719c")
        );
        $this->changeWorkspaceName = new ChangeWorkspaceName($this->workspaceRepository);
    }

    /**
     * @test
     */
    public function it_changes_name_of_workspace()
    {

        $user = UserFactory::create();

        $workspace = $this->changeWorkspaceName->execute(
            new ChangeWorkspaceNameRequest($this->workspace->id, "IT-updated")
        );

        $this->assertEquals('IT-updated', $workspace->name);
    }
}

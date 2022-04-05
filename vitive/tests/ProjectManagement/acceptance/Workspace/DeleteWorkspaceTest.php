<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Vitive\ProjectManagement\Domain\vo\WorkspaceId;
use Vitive\ProjectManagement\Domain\Workspace\WorkspaceRepository;
use Vitive\ProjectManagement\Application\Workspace\CreateWorkspace;
use Vitive\ProjectManagement\Application\Workspace\DeleteWorkspace;
use Vitive\ProjectManagement\Application\Commands\Workspace\WorkspaceRequest;
use Vitive\ProjectManagement\Infrastructure\Persistence\WorkspaceMemoryRepository;
use Vitive\ProjectManagement\Application\Commands\Workspace\DeleteWorkspaceRequest;

final class DeleteWorkspaceTest extends TestCase
{

    private WorkspaceRepository $workspaceRepository;
    private CreateWorkspace $createWorkspace;
    private DeleteWorkspace $deleteWorkspace;
    private $workspace;



    protected function setUp(): void
    {

        $this->workspaceRepository = new WorkspaceMemoryRepository();
        $this->createWorkspace = new CreateWorkspace($this->workspaceRepository);
        $this->deleteWorkspace = new DeleteWorkspace($this->workspaceRepository);

        $this->workspace = $this->createWorkspace->execute(
            new WorkspaceRequest("IT", "55e42502-79ee-47ac-b085-4571fc0f719c")
        );
    }

    /**
     * @test
     */
    public function it_deletes_workspace()
    {
        $this->expectException(DomainException::class);

        $this->deleteWorkspace->execute(new DeleteWorkspaceRequest($this->workspace->id));

        $this->workspaceRepository->ofId(
            WorkspaceId::fromString($this->workspace->id)
        );
    }
}

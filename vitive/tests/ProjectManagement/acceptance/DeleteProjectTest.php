<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Vitive\ProjectManagement\Application\Commands\Project\DeleteProjectRequest;
use Vitive\ProjectManagement\Application\Commands\Project\ProjectRequest;
use Vitive\ProjectManagement\Application\Project\CreateProject;
use Vitive\ProjectManagement\Domain\Project\ProjectRepository;
use Vitive\ProjectManagement\Application\Project\DeleteProject;
use Vitive\ProjectManagement\Domain\vo\ProjectId;
use Vitive\ProjectManagement\Infrastructure\Persistence\ProjectMemoryRepository;

final class DeleteProjectTest extends TestCase
{

    private ProjectRepository $projectRepository;
    private CreateProject $createProject;
    private DeleteProject $deleteProject;
    private $project;



    protected function setUp(): void
    {

        $this->projectRepository = new ProjectMemoryRepository();
        $this->createProject = new CreateProject($this->projectRepository);
        $this->deleteProject = new DeleteProject($this->projectRepository);

        $this->project = $this->createProject->execute(new ProjectRequest("project-1", '55e42502-79ee-47ac-b085-4571fc0f719c'));
    }



    /**
     * @test
     */
    public function it_deletes_a_project()
    {
        $this->expectException(DomainException::class);

        $this->deleteProject->execute(new DeleteProjectRequest($this->project->id));

        $this->projectRepository->ofId(
            ProjectId::fromString($this->project->id)
        );
    }
}

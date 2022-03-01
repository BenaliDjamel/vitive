<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Vitive\projectManagement\application\commands\DeleteProjectRequest;
use Vitive\projectManagement\application\commands\ProjectRequest;
use Vitive\projectManagement\application\project\CreateProject;
use Vitive\projectManagement\domain\ProjectRepository;
use Vitive\projectManagement\application\project\DeleteProject;
use Vitive\projectManagement\domain\Project;
use Vitive\projectManagement\domain\vo\ProjectId;
use Vitive\projectManagement\infrastructure\persistence\ProjectMemoryRepository;

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

        $this->project = $this->createProject->execute(new ProjectRequest("project-1"));
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

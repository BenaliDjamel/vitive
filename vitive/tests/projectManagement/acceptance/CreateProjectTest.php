<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Tests\projectManagement\common\UserFactory;
use Vitive\projectManagement\domain\ProjectRepository;
use Vitive\projectManagement\application\project\CreateProject;
use Vitive\projectManagement\application\commands\ProjectRequest;
use Vitive\projectManagement\infrastructure\persistence\ProjectMemoryRepository;

final class CreateProjectTest extends TestCase
{

    private ProjectRepository $projectRepository;
    private CreateProject $createProject;



    protected function setUp(): void
    {

        $this->projectRepository = new ProjectMemoryRepository();
        $this->createProject = new CreateProject($this->projectRepository);
    }

    /**
     * @test
     */
    public function it_create_a_project_without_an_owner()
    {
        $user = UserFactory::create();

        $project = $this->createProject->execute(new ProjectRequest("project-1", $user->id()));

        $this->assertEquals('project-1', $project->name);
    }
}

<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Tests\ProjectManagement\Common\UserFactory;
use Vitive\ProjectManagement\Domain\Project\ProjectRepository;
use Vitive\ProjectManagement\Application\Project\CreateProject;
use Vitive\ProjectManagement\Application\Commands\Project\ProjectRequest;
use Vitive\ProjectManagement\Infrastructure\Persistence\ProjectMemoryRepository;

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

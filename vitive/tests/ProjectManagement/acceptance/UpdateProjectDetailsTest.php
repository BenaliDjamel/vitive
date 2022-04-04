<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Vitive\ProjectManagement\Application\Commands\Project\UpdateProjectRequest;
use Vitive\ProjectManagement\Application\Project\UpdateProjectDetails;
use Vitive\ProjectManagement\Domain\Project\ProjectRepository;
use Vitive\ProjectManagement\Infrastructure\Persistence\ProjectMemoryRepository;
use Tests\ProjectManagement\Common\ProjectFactory;
use Tests\ProjectManagement\Common\UserFactory;

final class UpdateProjectDetailsTest extends TestCase
{

    private ProjectRepository $projectRepository;
    private UpdateProjectDetails $updateProjectDetails;



    protected function setUp(): void
    {

        $this->projectRepository = new ProjectMemoryRepository();
        $this->updateProjectDetails = new UpdateProjectDetails($this->projectRepository);
    }

    /**
     * @test
     */
    public function it_update_project_name()
    {
        $user = UserFactory::create();
        $project = ProjectFactory::create(creatorId: $user->id());

        $project = $this->projectRepository->save($project);

        $project = $this->updateProjectDetails->execute(new UpdateProjectRequest($project->id(), "vitive"));

        $this->assertSame('vitive', $project->name);
    }
}

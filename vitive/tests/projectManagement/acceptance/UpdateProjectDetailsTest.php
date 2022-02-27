<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Vitive\projectManagement\application\commands\UpdateProjectRequest;
use Vitive\projectManagement\application\project\UpdateProjectDetails;
use Vitive\projectManagement\domain\ProjectRepository;
use Vitive\projectManagement\infrastructure\persistence\ProjectMemoryRepository;
use Tests\projectManagement\common\ProjectFactory;

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

        $project = $this->projectRepository->save(ProjectFactory::create());

        $project = $this->updateProjectDetails->execute(new UpdateProjectRequest($project->id(), "vitive"));

        $this->assertSame('vitive', $project->name);
    }
}

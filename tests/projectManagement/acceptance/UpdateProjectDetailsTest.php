<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use Vitive\projectManagement\application\commands\UpdateProjectRequest;
use Vitive\projectManagement\application\CreateProject;
use Vitive\projectManagement\application\UpdateProjectDetails;
use Vitive\projectManagement\domain\Project;
use Vitive\projectManagement\domain\ProjectRepository;
use Vitive\projectManagement\domain\vo\ProjectId;
use Vitive\projectManagement\infrastructure\persistence\MemoryRepository;
use Tests\projectManagement\common\ProjectFactory;

final class UpdateProjectDetailsTest extends TestCase {

    private ProjectRepository $projectRepository;
    private UpdateProjectDetails $updateProjectDetails;

    

    protected function setUp(): void
    {

        $this->projectRepository = new MemoryRepository();
        $this->updateProjectDetails = new UpdateProjectDetails($this->projectRepository);
        
    }

    /**
     * @test
     */
    public function update_project_details() {

        $project = $this->projectRepository->save(ProjectFactory::create());

        $project = $this->updateProjectDetails->updateProject(new UpdateProjectRequest($project->id(), "vitive"));

        $this->assertSame('vitive', $project->name);
        

    }




}
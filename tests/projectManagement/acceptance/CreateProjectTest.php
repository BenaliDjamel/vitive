<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use Vitive\projectManagement\domain\ProjectRepository;
use Vitive\projectManagement\application\CreateProject;
use Vitive\projectManagement\application\commands\ProjectRequest;
use Vitive\projectManagement\infrastructure\persistence\MemoryRepository;

final class CreateProjectTest extends TestCase { 

    private ProjectRepository $project_repository;
    private CreateProject $createProject;

    

    protected function setUp(): void
    {

        $this->project_repository = new MemoryRepository();
        $this->createProject = new CreateProject( $this->project_repository);
        
    }



    /**
     * @test
     */
    public function can_create_a_project() {

         $project = $this->createProject->createProject(new ProjectRequest("id-1", "project-1"));

         $this->assertEquals('project-1', $project->name);



    }

}
<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use Vitive\projectManagement\domain\ProjectRepository;
use Vitive\projectManagement\application\CreateProject;
use Vitive\projectManagement\application\commands\ProjectRequest;
use Vitive\projectManagement\infrastructure\persistence\MemoryRepository;

final class CreateProjectTest extends TestCase { 

    private ProjectRepository $projectRepository;
    private CreateProject $createProject;

    

    protected function setUp(): void
    {

        $this->projectRepository = new MemoryRepository();
        $this->createProject = new CreateProject( $this->projectRepository);
        
    }



    /**
     * @test
     */
    public function can_create_a_project() {

         $project = $this->createProject->execute(new ProjectRequest( "project-1"));

         $this->assertEquals('project-1', $project->name);

    }

}
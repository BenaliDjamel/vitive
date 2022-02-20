<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use Vitive\projectManagement\application\AddProjectOwner;
use Vitive\projectManagement\application\commands\AddProjectOwnerRequest;
use Vitive\projectManagement\domain\ProjectRepository;
use Vitive\projectManagement\application\CreateProject;
use Vitive\projectManagement\application\commands\ProjectRequest;
use Vitive\projectManagement\infrastructure\persistence\MemoryRepository;
use Tests\projectManagement\common\ProjectFactory;

use function PHPUnit\Framework\assertSame;

final class AddProjectOwnerTest extends TestCase {


    private ProjectRepository $projectRepository;
    private AddProjectOwner $addProjectOwner;

    

    protected function setUp(): void
    {

        $this->projectRepository = new MemoryRepository();
        $this->addProjectOwner = new AddProjectOwner( $this->projectRepository);
        
    }

    /**
     * @test
     */
    public function it_add_an_owner_to_a_project() {
        $ownerId = "55e42502-79ee-47ac-b085-4571fc0f719c";
        $project = ProjectFactory::create();
        $this->projectRepository->save($project);


        $this->addProjectOwner->addOwner(new AddProjectOwnerRequest($project->id(), $ownerId));

        $this->assertSame($ownerId, $project->owner());

    }

 }
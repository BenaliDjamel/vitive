<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Vitive\ProjectManagement\Application\Project\AddProjectOwner;
use Vitive\ProjectManagement\Application\Commands\Project\AddProjectOwnerRequest;
use Vitive\ProjectManagement\Domain\Project\ProjectRepository;
use Vitive\ProjectManagement\Infrastructure\Persistence\ProjectMemoryRepository;
use Tests\ProjectManagement\Common\ProjectFactory;
use Tests\ProjectManagement\Common\UserFactory;

final class AddProjectOwnerTest extends TestCase
{


    private ProjectRepository $projectRepository;
    private AddProjectOwner $addProjectOwner;



    protected function setUp(): void
    {

        $this->projectRepository = new ProjectMemoryRepository();
        $this->addProjectOwner = new AddProjectOwner($this->projectRepository);
    }

    /**
     * @test
     */
    public function it_add_an_owner_to_a_project()
    {
        $ownerId = "55e42502-79ee-47ac-b085-4571fc0f719c";
        $user = UserFactory::create();
        $project = ProjectFactory::create(creatorId: $user->id());

        $this->projectRepository->save($project);


        $this->addProjectOwner->execute(new AddProjectOwnerRequest($project->id(), $ownerId));

        $this->assertSame($ownerId, $project->owner());
    }
}

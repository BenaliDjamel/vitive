<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Tests\projectManagement\common\ProjectFactory;
use Vitive\projectManagement\application\commands\AddProjectMemberRequest;
use Vitive\projectManagement\application\commands\ProjectResponse;
use Vitive\projectManagement\application\project\AddProjectMember;
use Vitive\projectManagement\domain\member\MemberRepository;
use Vitive\projectManagement\domain\ProjectRepository;
use Vitive\projectManagement\domain\vo\MemberId;
use Vitive\projectManagement\domain\vo\ProjectId;
use Vitive\projectManagement\infrastructure\persistence\MemberMemoryRepository;
use Vitive\projectManagement\infrastructure\persistence\MemoryRepository;

final class AddProjectMemberTest extends TestCase
{
    private ProjectRepository $projectRepository;
    private AddProjectMember $addProjectMember;



    protected function setUp(): void
    {

        $this->projectRepository = new MemoryRepository();
        $this->addProjectMember = new AddProjectMember($this->projectRepository);
    }


    /**
     * @test
     */
    public function it_add_a_member_to_project()
    {
        $memberId = "55e42502-79ee-47ac-b085-4571fc0f719c";
        $project = ProjectFactory::create();
        $this->projectRepository->save($project);

        $response = $this->addProjectMember->execute(new AddProjectMemberRequest($project->id(), $memberId));

        $this->assertEquals(new ProjectResponse(
            $project->id(),
            $project->name(),
            $project->owner(),
            $project->dueDate(),
            $project->members()
        ), $response);
    }
}

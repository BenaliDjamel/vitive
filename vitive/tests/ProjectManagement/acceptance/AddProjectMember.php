<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Tests\ProjectManagement\common\MemberFactory;
use Tests\ProjectManagement\common\ProjectFactory;
use Tests\ProjectManagement\common\UserFactory;
use Vitive\ProjectManagement\application\commands\AddProjectMemberRequest;
use Vitive\ProjectManagement\application\commands\ProjectResponse;
use Vitive\ProjectManagement\application\project\AddProjectMember;
use Vitive\ProjectManagement\domain\member\MemberRepository;
use Vitive\ProjectManagement\domain\ProjectRepository;
use Vitive\ProjectManagement\infrastructure\persistence\MemberMemoryRepository;
use Vitive\ProjectManagement\infrastructure\persistence\ProjectMemoryRepository;

final class AddProjectMemberTest extends TestCase
{
    private ProjectRepository $projectRepository;
    private AddProjectMember $addProjectMember;
    private MemberRepository $memberRepository;



    protected function setUp(): void
    {

        $this->projectRepository = new ProjectMemoryRepository();
        $this->memberRepository = new MemberMemoryRepository();
        $this->addProjectMember = new AddProjectMember($this->projectRepository, $this->memberRepository);
    }


    /**
     * @test
     */
    public function it_add_a_member_to_project()
    {
        $memberId = "55e42502-79ee-47ac-b085-4571fc0f719c";
        $user = UserFactory::create();

        $project = ProjectFactory::create(creatorId: $user->id());

        $this->projectRepository->save($project);

        /* memberEmail = "djamel@benali.com";
        $memberFullName = "djamel benali"; */
        $member = MemberFactory::create();
        $this->memberRepository->save($member);


        $response = $this->addProjectMember->execute(new AddProjectMemberRequest($project->id(), $member->id()));

        $this->assertEquals(new ProjectResponse(
            $project->id(),
            $project->name(),
            $project->owner(),
            $project->dueDate(),
            $project->members()
        ), $response);
    }
}

<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Vitive\projectManagement\application\project\UserDoesNotExistException;
use Tests\projectManagement\common\MemberFactory;
use Tests\projectManagement\common\ProjectFactory;
use Tests\projectManagement\common\UserFactory;
use Vitive\projectManagement\application\commands\AddProjectMemberRequest;
use Vitive\projectManagement\application\commands\ProjectResponse;
use Vitive\projectManagement\application\project\AddProjectMember;
use Vitive\projectManagement\domain\member\MemberRepository;
use Vitive\projectManagement\domain\ProjectRepository;
use Vitive\projectManagement\domain\vo\MemberId;
use Vitive\projectManagement\domain\vo\ProjectId;
use Vitive\projectManagement\infrastructure\persistence\MemberMemoryRepository;
use Vitive\projectManagement\infrastructure\persistence\ProjectMemoryRepository;

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

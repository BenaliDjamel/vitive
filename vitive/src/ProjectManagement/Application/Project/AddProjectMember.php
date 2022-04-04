<?php

declare(strict_types=1);

namespace Vitive\ProjectManagement\application\project;

use Vitive\ProjectManagement\Application\Commands\Project\AddProjectMemberRequest;
use Vitive\ProjectManagement\Application\Commands\Project\ProjectResponse;
use Vitive\ProjectManagement\Domain\Member\MemberRepository;
use Vitive\ProjectManagement\Domain\ProjectRepository;
use Vitive\ProjectManagement\Domain\vo\MemberId;
use Vitive\ProjectManagement\Domain\vo\ProjectId;

final class AddProjectMember
{

    public function __construct(private ProjectRepository $projectRepository, private MemberRepository $memberRepository)
    {
    }

    public function execute(AddProjectMemberRequest $request): ProjectResponse
    {

        $project = $this->projectRepository->ofId(ProjectId::fromString($request->projectId));
        $member = $this->memberRepository->ofId(MemberId::fromString($request->memberId));

        $project->addMember(MemberId::fromString($request->memberId));

        return new ProjectResponse($project->id(), $project->name(), $project->owner(), $project->dueDate(), $project->members());
    }
}

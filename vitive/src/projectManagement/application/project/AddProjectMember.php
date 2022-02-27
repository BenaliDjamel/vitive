<?php

declare(strict_types=1);

namespace Vitive\projectManagement\application\project;

use UserDoesNotExistException;
use Vitive\projectManagement\application\commands\AddProjectMemberRequest;
use Vitive\projectManagement\application\commands\ProjectResponse;
use Vitive\projectManagement\domain\member\MemberRepository;
use Vitive\projectManagement\domain\Project;
use Vitive\projectManagement\domain\ProjectRepository;
use Vitive\projectManagement\domain\vo\MemberId;
use Vitive\projectManagement\domain\vo\ProjectId;

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

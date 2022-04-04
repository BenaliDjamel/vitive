<?php

declare(strict_types=1);

namespace Vitive\ProjectManagement\application\project;

use DomainException;
use Vitive\ProjectManagement\Domain\vo\UserId;
use Vitive\ProjectManagement\Domain\vo\ProjectId;
use Vitive\ProjectManagement\Domain\Project\ProjectRepository;
use Vitive\ProjectManagement\Application\Commands\Project\AddProjectOwnerRequest;

final class AddProjectOwner
{


    public function __construct(private ProjectRepository $projectRepository)
    {
    }

    public function execute(AddProjectOwnerRequest $request)
    {

        $project = $this->projectRepository->ofId(ProjectId::fromString($request->projectId));

        if (!$project) {
            throw new DomainException("Project does not found.");
        }

        $project->addOwner(UserId::fromString($request->ownerId));

        $this->projectRepository->update($project);

        return $project;
    }
}

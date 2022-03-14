<?php

declare(strict_types=1);

namespace Vitive\projectManagement\application\project;

use DomainException;
use UserDoesNotExistException;
use Vitive\projectManagement\application\commands\AddProjectOwnerRequest;
use Vitive\projectManagement\application\commands\ProjectResponse;
use Vitive\projectManagement\domain\ProjectRepository;
use Vitive\projectManagement\domain\Project;
use Vitive\projectManagement\domain\vo\OwnerId;
use Vitive\projectManagement\domain\vo\ProjectId;

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

        $project->addOwner(OwnerId::fromString($request->ownerId));

        $this->projectRepository->update();

        return $project;
    }
}

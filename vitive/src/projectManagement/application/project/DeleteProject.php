<?php

declare(strict_types=1);

namespace Vitive\projectManagement\application\project;

use DomainException;
use Vitive\projectManagement\application\commands\DeleteProjectRequest;
use Vitive\projectManagement\application\commands\ProjectRequest;
use Vitive\projectManagement\application\commands\ProjectResponse;
use Vitive\projectManagement\domain\ProjectRepository;
use Vitive\projectManagement\domain\Project;
use Vitive\projectManagement\domain\vo\OwnerId;
use Vitive\projectManagement\domain\vo\ProjectId;

final class DeleteProject
{


    public function __construct(private ProjectRepository $projectRepository)
    {
    }

    public function execute(DeleteProjectRequest $request)
    {

        $id =  ProjectId::fromString($request->projectId);

        $project = $this->projectRepository->ofId($id);

        if (!$project) {
            throw new DomainException("Project does not found.");
        }

        $this->projectRepository->remove($project);
    }
}

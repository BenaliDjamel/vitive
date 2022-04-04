<?php

declare(strict_types=1);

namespace Vitive\ProjectManagement\Application\Project;

use DomainException;
use Vitive\ProjectManagement\Domain\vo\ProjectId;
use Vitive\ProjectManagement\Domain\Project\ProjectRepository;
use Vitive\ProjectManagement\Application\Commands\Project\DeleteProjectRequest;

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

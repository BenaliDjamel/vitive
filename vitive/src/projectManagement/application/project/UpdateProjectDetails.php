<?php

declare(strict_types=1);

namespace Vitive\projectManagement\application\project;

use DomainException;
use Exception;
use UserDoesNotExistException;
use Vitive\projectManagement\application\commands\UpdateProjectRequest;
use Vitive\projectManagement\application\commands\UpdateProjectResponse;
use Vitive\projectManagement\domain\ProjectRepository;
use Vitive\projectManagement\domain\Project;
use Vitive\projectManagement\domain\vo\ProjectId;

final class UpdateProjectDetails
{

    public function __construct(private ProjectRepository $projectRepository)
    {
    }

    public function execute(UpdateProjectRequest $request): UpdateProjectResponse
    {
        $id = ProjectId::fromString($request->id);

        $project = $this->projectRepository->ofId($id);

        if (!$project) {
            throw new DomainException("Project does not found.");
        }

        $project->updateName($request->name);

        // this will flush the repository so persist changes to DB
        $this->projectRepository->update();

        return new UpdateProjectResponse($project->id(), $project->name());
    }
}

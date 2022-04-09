<?php

declare(strict_types=1);

namespace Vitive\ProjectManagement\application\project;

use DomainException;
use Vitive\ProjectManagement\Application\Commands\Project\UpdateProjectRequest;
use Vitive\ProjectManagement\Application\Commands\Project\UpdateProjectResponse;
use Vitive\ProjectManagement\Domain\Project\ProjectRepository;
use Vitive\ProjectManagement\Domain\vo\ProjectId;

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

        $project->changeName($request->name);

        $this->projectRepository->update($project);

        return new UpdateProjectResponse($project->id(), $project->name());
    }
}

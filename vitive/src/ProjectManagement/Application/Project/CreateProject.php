<?php

declare(strict_types=1);

namespace Vitive\ProjectManagement\Application\Project;

use Vitive\ProjectManagement\Application\Commands\Project\ProjectRequest;
use Vitive\ProjectManagement\Application\Commands\Project\ProjectResponse;
use Vitive\ProjectManagement\Domain\Project\ProjectRepository;
use Vitive\ProjectManagement\Domain\Project\Project;
use Vitive\ProjectManagement\Domain\vo\OwnerId;
use Vitive\ProjectManagement\Domain\vo\UserId;

final class CreateProject
{


    public function __construct(private ProjectRepository $projectRepository)
    {
    }

    public function execute(ProjectRequest $request): ProjectResponse
    {

        $ownerId = $request->ownerId ? OwnerId::fromString($request->ownerId) : null;

        $project =  Project::create(
            $this->projectRepository->nextIdentity(),
            $request->name,
            UserId::fromString($request->creatorId),
            $ownerId,
            $request->dueDate
        );

        $response = $this->projectRepository->save($project);

        return new ProjectResponse($response->id(), $response->name());
    }
}

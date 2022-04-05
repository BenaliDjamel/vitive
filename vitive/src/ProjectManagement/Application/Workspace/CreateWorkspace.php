<?php

declare(strict_types=1);

namespace Vitive\ProjectManagement\Application\Workspace;

use Vitive\ProjectManagement\Domain\vo\UserId;
use Vitive\ProjectManagement\Domain\Workspace\Workspace;
use Vitive\ProjectManagement\Domain\Workspace\WorkspaceRepository;
use Vitive\ProjectManagement\Application\Commands\Workspace\WorkspaceRequest;
use Vitive\ProjectManagement\Application\Commands\Workspace\WorkspaceResponse;

final class CreateWorkspace
{


    public function __construct(private WorkspaceRepository $workspaceRepository)
    {
    }

    public function execute(WorkspaceRequest $request)
    {
        $workspace = Workspace::create(
            $this->workspaceRepository->nextIdentity(),
            $request->name,
            UserId::fromString($request->creatorId)
        );
       $response =  $this->workspaceRepository->save($workspace);

       return new WorkspaceResponse($response->id(), $response->name(), $response->creator());
    }
}

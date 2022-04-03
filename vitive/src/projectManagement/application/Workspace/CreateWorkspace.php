<?php

declare(strict_types=1);

namespace Vitive\projectManagement\application\Workspace;

use Vitive\projectManagement\application\commands\Workspace\WorkspaceRequest;
use Vitive\projectManagement\application\commands\Workspace\WorkspaceResponse;
use Vitive\projectManagement\domain\vo\UserId;
use Vitive\projectManagement\domain\Workspace\Workspace;
use Vitive\projectManagement\domain\Workspace\WorkspaceRepository;

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

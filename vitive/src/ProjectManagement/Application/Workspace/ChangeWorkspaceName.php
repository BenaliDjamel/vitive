<?php

declare(strict_types=1);

namespace Vitive\ProjectManagement\Application\Workspace;

use DomainException;
use Vitive\ProjectManagement\Domain\vo\WorkspaceId;
use Vitive\ProjectManagement\Domain\Workspace\WorkspaceRepository;
use Vitive\ProjectManagement\Application\Commands\Workspace\WorkspaceResponse;
use Vitive\ProjectManagement\Application\Commands\Workspace\ChangeWorkspaceNameRequest;

final class ChangeWorkspaceName
{


    public function __construct(private WorkspaceRepository $workspaceRepository)
    {
    }

    public function execute(ChangeWorkspaceNameRequest $request)
    {
        $workspace = $this->workspaceRepository->ofId(WorkspaceId::fromString($request->id));

        if (!$workspace) {
            throw new DomainException("Workspace not fount");
        }

        $workspace->changeName($request->name);

        $this->workspaceRepository->update($workspace);

        return new WorkspaceResponse($workspace->id(), $workspace->name(), $workspace->creator());
    }
}

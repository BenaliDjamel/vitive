<?php

declare(strict_types=1);

namespace Vitive\ProjectManagement\application\Workspace;

use DomainException;
use Vitive\ProjectManagement\domain\vo\WorkspaceId;
use Vitive\ProjectManagement\Domain\Workspace\WorkspaceRepository;
use Vitive\ProjectManagement\Application\Commands\Workspace\DeleteWorkspaceRequest;

final class DeleteWorkspace
{


    public function __construct(private WorkspaceRepository $workspaceRepository)
    {
    }

    public function execute(DeleteWorkspaceRequest $request)
    {
        $id =  WorkspaceId::fromString($request->id);

        $workspace = $this->workspaceRepository->ofId($id);

        if (!$workspace) {
            throw new DomainException("Workspace not found.");
        }

        $this->workspaceRepository->remove($workspace);
    }
}

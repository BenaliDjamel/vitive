<?php

declare(strict_types=1);

namespace Vitive\ProjectManagement\Infrastructure\Persistence;

use DomainException;
use Ramsey\Uuid\Uuid;
use Vitive\ProjectManagement\Domain\vo\WorkspaceId;
use Vitive\ProjectManagement\Domain\Workspace\Workspace;
use Vitive\ProjectManagement\Domain\Workspace\WorkspaceRepository;

final class WorkspaceMemoryRepository implements WorkspaceRepository
{


    private array $workspaces = [];

    public function ofId(WorkspaceId $id): Workspace
    {
        if (!isset($this->workspaces[$id->id()])) {
            throw new DomainException("Workspace not found");
        }

        return $this->workspaces[$id->id()];
    }

    public function save(Workspace $workspace): Workspace
    {

        $this->workspaces[$workspace->id()] = $workspace;

        return $this->workspaces[$workspace->id()];
    }

    public function nextIdentity(): WorkspaceId
    {
        return WorkspaceId::fromString(Uuid::uuid4()->toString());
    }

    public function update(Workspace $workspace)
    {
    }

    public function remove(Workspace $workspace)
    {

        unset($this->workspaces[$workspace->id()]);
    }
}

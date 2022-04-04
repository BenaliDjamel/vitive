<?php

declare(strict_types=1);

namespace Vitive\ProjectManagement\Domain\Workspace;

use Vitive\ProjectManagement\Domain\Workspace\Workspace;
use Vitive\ProjectManagement\Domain\vo\WorkspaceId;

interface WorkspaceRepository
{

    public function ofId(WorkspaceId $id): Workspace;
    public function save(Workspace $workspace): Workspace;
    public function nextIdentity(): WorkspaceId;
    public function update(Workspace $workspace);
    public function remove(Workspace $workspace);
}

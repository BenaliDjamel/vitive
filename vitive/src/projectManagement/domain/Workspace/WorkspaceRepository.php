<?php

declare(strict_types=1);

namespace Vitive\projectManagement\domain\Workspace;

use Vitive\projectManagement\domain\Workspace\Workspace;
use Vitive\projectManagement\domain\vo\WorkspaceId;

interface WorkspaceRepository
{

    public function ofId(WorkspaceId $id): Workspace;
    public function save(Workspace $workspace): Workspace;
    public function nextIdentity(): WorkspaceId;
    public function update(Workspace $workspace);
    public function remove(Workspace $workspace);
}

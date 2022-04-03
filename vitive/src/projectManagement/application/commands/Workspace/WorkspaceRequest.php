<?php

declare(strict_types=1);

namespace Vitive\projectManagement\application\commands\Workspace;


final class WorkspaceRequest
{

    public function __construct(
        public string $name,
        public string $creatorId
    ) {
    }
}

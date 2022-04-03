<?php

declare(strict_types=1);

namespace Vitive\projectManagement\application\commands\Workspace;


final class WorkspaceResponse
{


    public function __construct(
        public string $id,
        public string $name,
        public string $creatorId
    ) {
    }
}

<?php

declare(strict_types=1);

namespace Vitive\ProjectManagement\Application\Commands\Workspace;


final class ChangeWorkspaceNameRequest
{

    public function __construct(
        public string $id,
        public string $name
    ) {
    }
}

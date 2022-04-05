<?php

declare(strict_types=1);

namespace Vitive\ProjectManagement\Application\Commands\Workspace;


final class DeleteWorkspaceRequest
{

    public function __construct(
        public string $id
    ) {
    }
}

<?php

declare(strict_types=1);

namespace Vitive\ProjectManagement\Domain\Workspace;

use DomainException;
use Vitive\ProjectManagement\Domain\vo\UserId;
use Vitive\ProjectManagement\Domain\vo\WorkspaceId;

final class Workspace
{

    private function __construct(
        private WorkspaceId $id,
        private string $name,
        private UserId $creator
    ) {
    }

    public static function create(WorkspaceId $id, string $name, UserId $creator): Self
    {
        $name = trim($name);

        if (strlen($name) <= 1) {

            throw new DomainException();
        }

        return new Self($id, $name, $creator);
    }

    public function id(): string
    {
        return $this->id->id();
    }

    public function name(): string
    {
        return $this->name;
    }

    public function creator(): string
    {
        return $this->creator->id();
    }
}

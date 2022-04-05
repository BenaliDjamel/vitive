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

        return new Self($id, Self::validateName($name), $creator);
    }

    public function changeName(string $name)
    {
        $this->name = Self::validateName($name);
    }

    private static function validateName(string $name): string
    {
        $name = trim($name);

        if (strlen($name) <= 1) {

            throw new DomainException();
        }

        return $name;
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

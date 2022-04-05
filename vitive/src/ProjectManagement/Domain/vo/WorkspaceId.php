<?php

declare(strict_types=1);

namespace Vitive\ProjectManagement\Domain\vo;

use Assert\Assert;

final class WorkspaceId 
{

    private function __construct(private string $id)
    {

        Assert::that($id)->uuid();
    }

    public static function fromString(string $id): Self
    {
        return new Self($id);
    }

    public function id(): string
    {
        return $this->id;
    }

    public function __toString(): string
    {
        return $this->id();
    }
}

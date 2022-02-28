<?php

declare(strict_types=1);

namespace Vitive\projectManagement\application\commands;

use DateTimeImmutable;

final class UpdateProjectResponse
{

    public function __construct(public string $id, public string $name,  public ?string $owner = null, public ?DateTimeImmutable $dueDate = null, public ?array $members = [])
    {
    }
}

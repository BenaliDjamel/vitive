<?php

declare(strict_types=1);

namespace Vitive\projectManagement\application\commands;

use DateTimeImmutable;

final class ProjectRequest
{

    public function __construct(
        public string $name,
        public string $creatorId,
        public ?string $ownerId = null,
        public ?DateTimeImmutable $dueDate = null
    ) {
    }
}

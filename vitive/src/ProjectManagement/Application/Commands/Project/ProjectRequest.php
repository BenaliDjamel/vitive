<?php

declare(strict_types=1);

namespace Vitive\ProjectManagement\Application\Commands\Project;

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

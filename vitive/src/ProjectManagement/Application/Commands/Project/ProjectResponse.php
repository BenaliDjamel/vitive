<?php

declare(strict_types=1);

namespace Vitive\ProjectManagement\Application\Commands\Project;

use DateTimeImmutable;

final class ProjectResponse
{


    public function __construct(
        public string $id,
        public string $name,
        public ?string $owner = null,
        public ?DateTimeImmutable $dueDate = null,
        public ?array $members = []
    ) {
    }
}

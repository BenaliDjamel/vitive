<?php

declare(strict_types=1);

namespace Tests\ProjectManagement\Common;

use DateTimeImmutable;
use Vitive\ProjectManagement\Domain\Project\Project;
use Vitive\ProjectManagement\Domain\vo\ProjectId;
use Vitive\ProjectManagement\Domain\vo\UserId;

final class ProjectFactory
{


    private function __construct()
    {
    }

    public static function create(
        string $creatorId,
        string $id = "48e42502-79ee-47ac-b085-4571fc0f719c",
        string $name = "asana-cl",
        UserId $ownerId = null,
        DateTimeImmutable $dueDate = new DateTimeImmutable(),
    ): Project {

        $project =  Project::create(
            ProjectId::fromString($id),
            $name,
            UserId::fromString($creatorId),
            ownerId:$ownerId,
            dueDate: $dueDate
        );

        return $project;
    }
}

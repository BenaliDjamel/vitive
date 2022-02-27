<?php

declare(strict_types=1);

namespace Tests\projectManagement\common;

use PHPUnit\Framework\TestCase;
use Vitive\projectManagement\domain\Project;
use Vitive\projectManagement\domain\vo\ProjectId;

final class ProjectFactory
{


    private function __construct()
    {
    }

    public static function create(): Project
    {
        $project =  Project::create(
            ProjectId::fromString("48e42502-79ee-47ac-b085-4571fc0f719c"),
            "p-1"
        );

        return $project;
    }
}

<?php

declare(strict_types=1);

namespace Vitive\ProjectManagement\Application\Commands\Project;


final class UpdateProjectRequest
{

    public function __construct(public string $id, public string $name)
    {
    }
}

<?php

declare(strict_types=1);

namespace Vitive\ProjectManagement\Application\Commands\Project;


final class AddProjectMemberRequest
{

    public function __construct(public string $projectId, public string $memberId)
    {
    }
}

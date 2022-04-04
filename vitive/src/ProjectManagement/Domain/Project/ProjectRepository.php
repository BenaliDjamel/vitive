<?php

declare(strict_types=1);

namespace Vitive\ProjectManagement\Domain\Project;

use Vitive\ProjectManagement\Domain\Project\Project;
use Vitive\ProjectManagement\Domain\vo\ProjectId;

interface ProjectRepository
{

    public function ofId(ProjectId $id): Project;
    public function save(Project $project): Project;
    public function nextIdentity(): ProjectId;
    public function update(Project $project);
    public function remove(Project $project);
}

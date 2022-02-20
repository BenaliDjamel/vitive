<?php declare(strict_types=1);
namespace Vitive\projectManagement\domain;

use Vitive\projectManagement\domain\Project;
use Vitive\projectManagement\domain\vo\ProjectId;

interface ProjectRepository {

    public function save(Project $project): Project;
    public function nextIdentity(): ProjectId;
}
<?php declare(strict_types=1);
namespace Vitive\projectManagement\domain;

use Vitive\projectManagement\domain\Project;

interface ProjectRepository {

    public function save(Project $project): Project;
}
<?php declare(strict_types=1);
namespace Vitive\projectManagement\infrastructure\persistence;


use Vitive\projectManagement\domain\ProjectRepository;
use Vitive\projectManagement\domain\Project;


final class MemoryRepository implements ProjectRepository {
  

    private array $projects = [];

    public function save(Project $project): Project {

        $this->projects[$project->id] = $project;

        return $this->projects[$project->id];
    }

}
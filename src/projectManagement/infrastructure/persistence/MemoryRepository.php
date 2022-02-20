<?php declare(strict_types=1);
namespace Vitive\projectManagement\infrastructure\persistence;


use Vitive\projectManagement\domain\ProjectRepository;
use Vitive\projectManagement\domain\Project;
use Vitive\projectManagement\domain\vo\ProjectId;
use Ramsey\Uuid\Uuid;


final class MemoryRepository implements ProjectRepository {
  

    private array $projects = [];

    public function save(Project $project): Project {

        $this->projects[$project->id()] = $project;

        return $this->projects[$project->id()];
    }

    public function nextIdentity(): ProjectId
    {
        return ProjectId::fromString(Uuid::uuid4()->toString());
    }

}
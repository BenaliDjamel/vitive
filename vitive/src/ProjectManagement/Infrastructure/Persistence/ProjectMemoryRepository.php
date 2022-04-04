<?php

declare(strict_types=1);

namespace Vitive\ProjectManagement\Infrastructure\Persistence;

use DomainException;
use Vitive\ProjectManagement\Domain\Project\ProjectRepository;
use Vitive\ProjectManagement\Domain\Project\Project;
use Vitive\ProjectManagement\Domain\vo\ProjectId;
use Ramsey\Uuid\Uuid;


final class ProjectMemoryRepository implements ProjectRepository
{


    private array $projects = [];

    public function ofId(ProjectId $id): Project
    {
        if (!isset($this->projects[$id->id()])) {
            throw new DomainException("Project does not found");
        }

        return $this->projects[$id->id()];
    }

    public function save(Project $project): Project
    {

        $this->projects[$project->id()] = $project;

        return $this->projects[$project->id()];
    }

    public function nextIdentity(): ProjectId
    {
        return ProjectId::fromString(Uuid::uuid4()->toString());
    }

    public function update(Project $project)
    {
    }

    public function remove(Project $project)
    {

        unset($this->projects[$project->id()]);
    }
}

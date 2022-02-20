<?php

declare(strict_types=1);

namespace Vitive\projectManagement\domain;

use DateTimeImmutable;
use Vitive\projectManagement\domain\vo\OwnerId;
use Vitive\projectManagement\domain\vo\ProjectId;

final class Project
{

    private function __construct(private ProjectId $projectId,  private string $name, private ?OwnerId $ownerId = null, private ?DateTimeImmutable $dueDate = null)
    {
    }

    public static function create(ProjectId $projectId, string $name, ?OwnerId $ownerId = null, ?DateTimeImmutable $dueDate = null): Self
    {

        if (!trim($name)) {
            throw new EmptyProjectNameException('Project name cannot be empty.');
        }

        return new Self($projectId, $name, $ownerId, $dueDate);
    }

    public function updateName(string $name)
    {
        if (!trim($name)) {
            throw new EmptyProjectNameException('Project name cannot be empty.');
        }

        $this->name = $name;
    }

    public function addOwner(OwnerId $owner)
    {

        $this->ownerId = $owner;
    }

    public function owner(): string
    {
        return $this->ownerId->id();
    }

    public function dueDate(): DateTimeImmutable {
        return $this->dueDate;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function id(): string
    {
        return $this->projectId->id();
    }
}

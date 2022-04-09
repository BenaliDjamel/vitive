<?php

declare(strict_types=1);

namespace Vitive\ProjectManagement\Domain\Project;

use DomainException;
use DateTimeImmutable;
use Vitive\ProjectManagement\Domain\vo\UserId;
use Vitive\ProjectManagement\Domain\vo\MemberId;
use Vitive\ProjectManagement\Domain\vo\ProjectId;

class Project
{

    private function __construct(
        private ProjectId $projectId,
        private string $name,
        private UserId $creatorId,
        private ?UserId $ownerId = null,
        private array $members = [],
        private ?DateTimeImmutable $dueDate = null
    ) {
    }

    public static function create(
        ProjectId $projectId,
        string $name,
        UserId $creatorId,
        ?UserId $ownerId = null,
        ?DateTimeImmutable $dueDate = null
    ): Self {
        Self::assertNonEmptyName($name);

        return new Self($projectId, $name, $creatorId, $ownerId, dueDate: $dueDate);
    }

    public function changeName(string $name)
    {

        Self::assertNonEmptyName($name);

        $this->name = $name;
    }

    public function addOwner(UserId $owner)
    {

        $this->ownerId = $owner;
    }

    public function addMember(MemberId $memberId)
    {
        $this->members[] = $memberId;
    }

    private static function assertNonEmptyName(string $name)
    {
        $name = trim($name);

        if (!$name) {
            throw new DomainException('Project should not be empty.');
        }
    }

    public function creator()
    {
        return $this->creatorId->id();
    }

    public function owner(): ?string
    {
        return $this->ownerId?->id();
    }

    public function members(): array
    {
        return $this->members;
    }

    public function dueDate(): ?DateTimeImmutable
    {
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

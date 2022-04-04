<?php

declare(strict_types=1);

namespace Vitive\ProjectManagement\Infrastructure\Persistence;

use DomainException;
use Vitive\ProjectManagement\Domain\User\UserRepository;
use Vitive\ProjectManagement\Domain\User\User;
use Vitive\ProjectManagement\Domain\vo\UserId;
use Ramsey\Uuid\Uuid;
use Vitive\ProjectManagement\Domain\vo\EmailAddress;

final class UserInMemoryRepository implements UserRepository
{


    private array $users = [];

    public function ofId(UserId $id): User
    {
        if (!isset($this->users[$id->id()])) {
            throw new DomainException("User does not found");
        }

        return $this->users[$id->id()];
    }
    
    public function ofEmail(EmailAddress $email)
    {
        foreach ($this->users as $user) {
            if ($user->email() === $email->email()) {
                return $user;
            }
        }

        return;
    }

    public function save(User $user): User
    {

        $this->users[$user->id()] = $user;

        return $this->users[$user->id()];
    }

    public function nextIdentity(): UserId
    {
        return UserId::fromString(Uuid::uuid4()->toString());
    }

    public function update()
    {
    }

    public function remove(User $user)
    {

        unset($this->users[$user->id()]);
    }
}

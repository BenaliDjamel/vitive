<?php

declare(strict_types=1);

namespace Vitive\projectManagement\infrastructure\persistence;

use DomainException;
use Vitive\projectManagement\domain\user\UserRepository;
use Vitive\projectManagement\domain\user\User;
use Vitive\projectManagement\domain\vo\UserId;
use Ramsey\Uuid\Uuid;
use Vitive\projectManagement\domain\vo\EmailAddress;

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

<?php

declare(strict_types=1);

namespace Vitive\projectManagement\domain\user;

use DomainException;
use Vitive\projectManagement\domain\vo\UserId;
use Vitive\projectManagement\domain\vo\EmailAddress;
use Assert\Assert;

class User
{
    private function __construct(private UserId $userId, private string $fullname, private EmailAddress $email, private string $password)
    {
    }

    public static function create(UserId $id, string $fullname, EmailAddress $email, string $password): Self
    {
        $password = trim($password);
       
        if(mb_strlen($password) < 8) {
            throw new DomainException('Password should at least 8 characters');
        }

        return new Self($id, $fullname, $email, $password);
    }

    public function fullname()
    {
        return $this->fullname;
    }

    public function email()
    {
        return $this->email->email();
    }

    public function id()
    {
        return $this->userId->id();
    }
}

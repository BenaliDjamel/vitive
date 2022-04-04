<?php

declare(strict_types=1);

namespace Tests\ProjectManagement\Common;

use Vitive\ProjectManagement\Domain\vo\UserId;
use Vitive\ProjectManagement\Domain\User\User;
use Vitive\ProjectManagement\Domain\vo\EmailAddress;

final class UserFactory
{


    private function __construct()
    {
    }

    public static function create(
        string $fullname = "djamel benali",
        string $email = "djamel@benali.com",
        string $password = "12345678"
    ): User {
        $user =  User::create(
            UserId::fromString("48e42502-79ee-47ac-b085-4571fc0f719c"),
            $fullname,
            EmailAddress::fromString($email),
            $password
        );

        return $user;
    }
}

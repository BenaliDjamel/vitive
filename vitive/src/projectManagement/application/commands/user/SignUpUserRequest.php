<?php

declare(strict_types=1);

namespace Vitive\projectManagement\application\commands\user;

final class SignUpUserRequest
{

    public function __construct(public string $fullname, public string $email, public string $password)
    {
    }
}

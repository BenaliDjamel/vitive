<?php

declare(strict_types=1);

namespace Vitive\ProjectManagement\Application\Commands\User;

final class SignUpUserRequest
{

    public function __construct(public string $fullname, public string $email, public string $password)
    {
    }
}

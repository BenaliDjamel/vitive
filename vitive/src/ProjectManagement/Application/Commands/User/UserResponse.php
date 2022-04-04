<?php

declare(strict_types=1);

namespace Vitive\ProjectManagement\Application\Commands\User;


final class UserResponse
{


    public function __construct(
        public string $id,
        public string $fullname,
        public string $email
    ) {
    }
}

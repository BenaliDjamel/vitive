<?php

declare(strict_types=1);

namespace Vitive\projectManagement\application\commands\user;


final class UserResponse
{


    public function __construct(
        public string $id,
        public string $fullname,
        public string $email
    ) {
    }
}

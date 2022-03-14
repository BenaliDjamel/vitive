<?php

use Vitive\projectManagement\domain\vo\EmailAddress;
use Vitive\projectManagement\domain\vo\UserId;

$factory->define(Vitive\projectManagement\domain\user\User::class, function (Faker\Generator $faker) {
    return [
        'userId' => UserId::fromString($faker->uuid()),
        'fullname' => $faker->name,
        'email' => EmailAddress::fromString($faker->email),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password

    ];
});

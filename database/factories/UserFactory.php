<?php

namespace Database\Factories;
 
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Vitive\projectManagement\domain\vo\UserId;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => UserId::fromString($this->faker->uuid()),
            'fullname' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }
}


/* use Vitive\projectManagement\domain\vo\EmailAddress;
use Vitive\projectManagement\domain\vo\UserId;

$factory->define(Vitive\projectManagement\domain\user\User::class, function (Faker\Generator $faker) {
    return [
        'userId' => UserId::fromString($faker->uuid()),
        'fullname' => $faker->name,
        'email' => EmailAddress::fromString($faker->email),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password

    ];
});
 */
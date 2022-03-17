<?php


namespace Database\Factories;

use App\Models\User;
use DateTimeImmutable;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Vitive\projectManagement\domain\vo\ProjectId;
use Vitive\projectManagement\domain\vo\UserId;

class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => ProjectId::fromString($this->faker->uuid()),
            'name' => $this->faker->name(),
            'dueDate' => new DateTimeImmutable(),
            'creator_id' => User::factory(),
        ];
    }
}


/* use Vitive\projectManagement\domain\vo\ProjectId;

$factory->define(Vitive\projectManagement\domain\Project::class, function (Faker\Generator $faker) {
    return [
        'projectId' => ProjectId::fromString($faker->uuid()),
        'name' => $faker->name,
        'dueDate' => new DateTimeImmutable(),
    ];
});
 */
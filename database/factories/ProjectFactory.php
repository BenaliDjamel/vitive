<?php


namespace Database\Factories;

use App\Models\User;
use DateTimeImmutable;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'id' => $this->faker->uuid(),
            'name' => $this->faker->name(),
            'due_date' => new DateTimeImmutable(),
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
<?php

use Vitive\projectManagement\domain\vo\ProjectId;

$factory->define(Vitive\projectManagement\domain\Project::class, function (Faker\Generator $faker) {
    return [
        'projectId' => ProjectId::fromString($faker->uuid()),
        'name' => $faker->name,
        'dueDate' => new DateTimeImmutable(),
    ];
});

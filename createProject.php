<?php

use Vitive\projectManagement\domain\Project;
use Vitive\projectManagement\domain\vo\ProjectId;

require_once "bootstrap.php";

$project =  Project::create(
    ProjectId::fromString("78e42502-79ee-47ac-b085-4571fc0f719c"),
    "p-1", 
    dueDate: new DateTimeImmutable()
);
$entityManager->persist($project);
$entityManager->flush();

echo "Created Project with ID " . $project->id() . "\n"; 
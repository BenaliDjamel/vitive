<?php

use Vitive\projectManagement\domain\Project;
use Vitive\projectManagement\domain\vo\ProjectId;
use Vitive\projectManagement\infrastructure\persistence\doctrine\ProjectRepository;

require_once "bootstrap.php";



$projectRepository = new ProjectRepository($entityManager);

$project =  Project::create(
    $projectRepository->nextIdentity(),
    "p-1", 
    dueDate: new DateTimeImmutable()
);

$project = $projectRepository->save($project);

echo "Created Project with ID " . $project->id() . "\n"; 
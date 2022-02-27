<?php
require_once "bootstrap.php";

$projectRepository = $entityManager->getRepository('Vitive\projectManagement\domain\Project');
$projects = $projectRepository->findAll();

foreach ($projects as $project) {
    echo sprintf("-%s\n", $project->name());
    echo sprintf("-%s\n", $project->id());
    echo sprintf("-%s\n", $project->dueDate()->format('Y-m-d'));
}
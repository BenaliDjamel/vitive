<?php declare(strict_types=1);
namespace Vitive\projectManagement\application;

use Vitive\projectManagement\application\commands\ProjectRequest;
use Vitive\projectManagement\application\commands\ProjectResponse;
use Vitive\projectManagement\domain\ProjectRepository;
use Vitive\projectManagement\domain\Project;
use Vitive\projectManagement\domain\vo\ProjectId;

final class CreateProject {


    public function __construct(private ProjectRepository $projectRepository){}

    public function execute(ProjectRequest $request) : ProjectResponse{

        $project =  Project::create($this->projectRepository->nextIdentity(), $request->name);
        
        $response = $this->projectRepository->save($project);

        return new ProjectResponse($response->id(), $response->name());

    }



}


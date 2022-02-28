<?php

namespace App\Http\Controllers;

use DateTimeImmutable;
use Illuminate\Http\Request;
use Vitive\projectManagement\application\commands\ProjectRequest;
use Vitive\projectManagement\application\project\CreateProject;

class ProjectController extends Controller
{

    private  $createProject;

    public function __construct(CreateProject $createProject)
    {
        $this->createProject =  $createProject;
    }


    public function store(Request $request)
    {
        $project =  $this->createProject->execute(
            new ProjectRequest(
                $request->name,
                dueDate: new DateTimeImmutable()
            )
        );

        return response()->json([
            'id' => $project->id,
            'name' => $project->name,
            'dueDate' => $project->dueDate,
            'owner' => $project->owner,
            'members' => $project->members
        ]);
    }
}

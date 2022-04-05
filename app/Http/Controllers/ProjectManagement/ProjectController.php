<?php

namespace App\Http\Controllers\ProjectManagement;


use DateTimeImmutable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Vitive\ProjectManagement\Application\Project\CreateProject;
use Vitive\ProjectManagement\Application\Commands\Project\ProjectRequest;

class ProjectController extends Controller
{

    public function __construct(private CreateProject $createProject)
    {
    }


    public function store(Request $request)
    {
        $project =  $this->createProject->execute(
            new ProjectRequest(
                $request->name,
                $request->user()->id,
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

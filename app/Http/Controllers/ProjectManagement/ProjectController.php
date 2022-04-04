<?php

namespace App\Http\Controllers\ProjectManagement;

use App\Http\Controllers\Controller;

use DateTimeImmutable;
use Illuminate\Http\Request;
use Vitive\ProjectManagement\Application\Commands\Project\ProjectRequest;
use Vitive\ProjectManagement\Application\Project\CreateProject;

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

<?php

namespace App\Http\Controllers\ProjectManagement;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Vitive\ProjectManagement\Application\Commands\Project\UpdateProjectRequest;
use Vitive\ProjectManagement\Application\Project\UpdateProjectDetails;

class UpdateProjectController extends Controller
{

    public function __construct(private UpdateProjectDetails $updateProject)
    {
    }


    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $id)
    {
        
        $project = $this->updateProject->execute(new UpdateProjectRequest($id, $request->name));


        return response()->json([
            'id' => $project->id,
            'name' => $project->name,
            'dueDate' => $project->dueDate,
            'owner' => $project->owner,
            'members' => $project->members
        ]);
    }
}

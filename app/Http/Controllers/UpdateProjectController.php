<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Vitive\projectManagement\application\commands\UpdateProjectRequest;
use Vitive\projectManagement\application\project\UpdateProjectDetails;

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

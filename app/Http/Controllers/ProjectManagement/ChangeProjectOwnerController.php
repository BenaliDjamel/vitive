<?php

namespace App\Http\Controllers\ProjectManagement;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Vitive\ProjectManagement\Application\Commands\Project\AddProjectOwnerRequest;
use Vitive\ProjectManagement\Application\Project\AddProjectOwner;

class ChangeProjectOwnerController extends Controller
{

    public function __construct(private AddProjectOwner $addProjectOwner)
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

        $project =  $this->addProjectOwner->execute(
            new AddProjectOwnerRequest($id, $request->ownerId)
        );

        return response()->json([
            'id' => $project->id(),
            'name' => $project->name(),
            'dueDate' => $project->dueDate(),
            'owner' => $project->owner(),
        ]);
    }
}

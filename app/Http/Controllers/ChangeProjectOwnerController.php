<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Vitive\projectManagement\application\commands\AddProjectOwnerRequest;
use Vitive\projectManagement\application\project\AddProjectOwner;

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

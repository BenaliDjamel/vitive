<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Vitive\projectManagement\application\commands\Workspace\WorkspaceRequest;
use Vitive\projectManagement\application\Workspace\CreateWorkspace;

class CreateWorkspaceController extends Controller
{

    public function __construct(private CreateWorkspace $createWorkspace)
    {
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $workspace =  $this->createWorkspace->execute(new WorkspaceRequest(
            $request->name,
            $request->user()->id
        ));

        return response()->json([
            'id' => $workspace->id,
            'name' => $workspace->name,
            'creator' => $workspace->creatorId,
        ]);
    }
}

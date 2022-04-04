<?php

namespace App\Http\Controllers\ProjectManagement;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Vitive\ProjectManagement\Application\Commands\Workspace\WorkspaceRequest;
use Vitive\ProjectManagement\Application\Workspace\CreateWorkspace;

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

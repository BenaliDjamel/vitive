<?php

namespace App\Http\Controllers\ProjectManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Vitive\ProjectManagement\Application\Commands\Workspace\ChangeWorkspaceNameRequest;
use Vitive\ProjectManagement\Application\Workspace\ChangeWorkspaceName;


class ChangeWorkspaceNameController extends Controller
{
    public function __construct(private ChangeWorkspaceName $changeWorkspaceName)
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
        $request->validate([
            'name' => ['required', 'min:2', 'max:20']
        ]);

        $workspace = $this->changeWorkspaceName->execute(
            new ChangeWorkspaceNameRequest($id, $request->name)
        );

        return response()->json([
            'id' => $workspace->id,
            'name' => $workspace->name,
            'creator' => $workspace->creatorId,
        ]);
    }
}

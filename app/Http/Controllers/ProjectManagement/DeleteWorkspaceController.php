<?php


namespace App\Http\Controllers\ProjectManagement;

use App\Http\Controllers\Controller;


use Illuminate\Http\Request;
use Vitive\ProjectManagement\Application\Workspace\DeleteWorkspace;
use Vitive\ProjectManagement\Application\Commands\Workspace\DeleteWorkspaceRequest;

class DeleteWorkspaceController extends Controller
{
    public function __construct(private DeleteWorkspace $deleteWorkspace)
    {
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id)
    {
        $this->deleteWorkspace->execute(new DeleteWorkspaceRequest($id));
    }
}

<?php

namespace App\Http\Controllers\ProjectManagement;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Vitive\ProjectManagement\Application\Project\DeleteProject;
use Vitive\ProjectManagement\Application\Commands\Project\DeleteProjectRequest;

class DeleteProjectController extends Controller
{

    public function __construct(private DeleteProject $deleteProject)
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
        $this->deleteProject->execute(new DeleteProjectRequest($id));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Vitive\projectManagement\application\commands\DeleteProjectRequest;
use Vitive\projectManagement\application\project\DeleteProject;

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

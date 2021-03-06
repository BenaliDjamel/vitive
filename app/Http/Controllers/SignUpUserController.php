<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignupRequest;
use Illuminate\Http\Request;
use Vitive\ProjectManagement\Application\Commands\User\SignUpUserRequest;
use Vitive\ProjectManagement\Application\User\SignUpUser;

class SignUpUserController extends Controller
{

    public function __construct(private SignUpUser $signupUser)
    {
    }


    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(SignupRequest $request)
    {
        $user = $this->signupUser->execute(new SignUpUserRequest(
            $request->fullname,
            $request->email,
            $request->password
        ));
   
        return response()->json([
            'id' => $user->id(),
            'fullname' => $user->fullname(),
            'email' => $user->email(),
        ]);
    }
}

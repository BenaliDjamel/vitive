<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Vitive\projectManagement\application\commands\user\SignUpUserRequest;
use Vitive\projectManagement\application\commands\user\UserResponse;
use Vitive\projectManagement\application\user\SignUpUser;

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
    public function __invoke(Request $request)
    {
        $user = $this->signupUser->execute(new SignUpUserRequest(
            $request->fullname,
            $request->email,
            $request->password
        ));
   
        return response()->json([
            'id' => $user->id,
            'fullname' => $user->fullname,
            'email' => $user->email,
        ]);
    }
}

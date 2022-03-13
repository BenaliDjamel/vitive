<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Vitive\projectManagement\application\commands\user\SignUpUserRequest;
use Vitive\projectManagement\application\user\SignUpUser;

class RegisteredUserController extends Controller
{

    public function __construct(private SignUpUser $signupUser)
    {
    }

    
    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'fullname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:Vitive\projectManagement\domain\user\User'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

       /*  $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]); */

        $user = $this->signupUser->execute(new SignUpUserRequest(
            $request->fullname,
            $request->email,
            Hash::make($request->password)
        ));

        event(new Registered($user));

        Auth::login($user);
        return response()->noContent();
    }
}

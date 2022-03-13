<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
{

    /**
     * Indicates if the validator should stop on the first rule failure.
     *
     * @var bool
     */
    protected $stopOnFirstFailure = true;


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => ['required', 'email', 'unique:Vitive\projectManagement\domain\user\User'],
            'fullname' => ['required', 'min:2', 'max:20'],
            'password' => ['required', 'min:8', 'max:20']
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'An email is required',
            'email.email' => 'It is not a valid email',
            'email.unique' => 'Email already exists',
            'password.required' => 'A password is required',
            'password.min' => 'A password should be at least 8 characters',
            'password.max' => 'A password should be no longer than 20 characters',
            'fullname.min' => 'A fullname should be at least 2 characters',
            'fullname.max' => 'A fullname should be no longer than 20 characters',

        ];
    }
}

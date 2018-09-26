<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
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
            'name' => ['required','alpha','max:100'],
            'email' => ['required','email'],
            'password' =>['required'],
        ];
    }

    public function messages(){
        return[
            'name.required' => 'The name cannot be null',
            'name.alpha' => 'The cannot have numbers',
            'name.max' => 'The must be less that 100 characters',
            'email.required' => 'The email cannot be null',
            'email.email' => 'The email must be a real email address',
            'password.required' => 'the password cannot be null',
        ];
    }
}

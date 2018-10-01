<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateLoginRequest extends FormRequest
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
            'email'       => 'required|string|email',
            'password'    => 'required|string',
            'remember_me' => 'boolean',
        ];
    }


    public function messages()
    {
        return[
            'email.required' => 'The email cannot be null',
            'email.email' => 'The email must be a real email address',
            'password.required' => 'the password cannot be null',
            'remember_me.boolean' => 'remember me must be boolean'
        ];
    }
}

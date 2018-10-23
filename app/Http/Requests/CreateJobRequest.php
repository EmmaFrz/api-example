<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateJobRequest extends FormRequest
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
            'name' => ['required','string','max:50'],
            'description' => ['required','max:240'],
            'price' => ['required','integer'],
        ];
    }


    public function messages(){
        return [
            'name.required' => 'Name must be required',
            'name.string' => 'Name must not contain numbers',
            'name.max' => 'Name must not be bigger that 50 character',
            'description.required' =>'description must be required',
            'description.max' => 'description must contain 240 characters max',
            'price.request' => 'Price must be required',
            'price.integer' => 'price must be numeric',
            'price.max' => 'price must be max 10 characters'
        ];
    }
}

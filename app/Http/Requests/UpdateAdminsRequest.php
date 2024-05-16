<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
class UpdateAdminsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        $id = $this->id ? ','. $this->id : null;
        $rules = [
            'name' => 'bail|required|min:1|max:50',
            'email' => 'bail|required|email|unique:admins,email'. $id .'',
        ];
        
        if (request()->isMethod('put')) {
            if (!empty($this->password)) {
                $rules['password'] = 'bail|required|min:6|max:20';
            }
        } else {
            $rules['password'] = 'bail|required|min:6|max:20';
        }
        return $rules;
    }
    public function messages(){
        return[
            'name.required' => 'Name is required',
            'name.min' => 'Name must be at least 1 characters',
            'name.max' => 'Name must be at most 50 characters',  
            'email.required' => 'Email is required',
            'email.email' => 'Email is invalid',
            'email.unique' => 'Email is already token, please choose another one',
            'password.required' => 'Password is required',
            'password.string' => 'Password must be a string',
            'password.min' => 'Password must be at least 6 characters',
            'password.max' => 'Password must be at most 20 characters',
        ];
    }
    public function failedValidation(validator $validator){
        throw(new ValidationException($validator))
        ->errorBag($this->errorBag)
        ->redirectTo($this->getRedirectUrl());
    }
}

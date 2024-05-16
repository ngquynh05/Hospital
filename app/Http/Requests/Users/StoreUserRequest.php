<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
class StoreUserRequest extends FormRequest
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
        return [
            
            'email' => 'required|email',
            'password' => 'required|min:6|max:20'

        ];
    }

    public function massage(){
        return [
            
            'email.required' => 'Vui long nhap email',
            'email.email' => 'Email khong hop le',
            'password.required' => 'Vui long nhap mat khau',
            'password.min' => 'Mat khau co it nhat 6 ky tu',
            'password.max' => 'Mat khau nhieu nhat 20 ky tu'
        ];
    }

    public function failedValidation(validator $validator){
        throw(new ValidationException($validator))
        ->errorBag($this->errorBag)
        ->redirectTo($this->getRedirectUrl());
    }
}

<?php

namespace App\Http\Requests\Subjects;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;

class StoreSubjectRequest extends FormRequest
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
            'name'=> 'required',
            'price' => 'required|numeric'
        ];

    }

    public function messages(){
        return[
            'name.required' => 'Vui lòng nhập tên dịch vụ khám',
            'price.required' => 'Vui lòng nhập giá dịch vụ',
            'price.numeric' => 'Giá dịch vụ là chữ số'
        ];
    }

    public function failedValidation(validator $validator){
        throw(new ValidationException($validator))
        ->errorBag($this->errorBag)
        ->redirectTo($this->getRedirectUrl());
    }

}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
            'username' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:5|max:10',
            // 'password_confirmation' => 'required',
            'role' => 'nullable',
            'contact' => 'decimal:11,13|nullable',
            'address' => 'string|nullable',
            'image' => 'string|nullable',
            'status' => 'integer|nullable'
        ];
    }
}

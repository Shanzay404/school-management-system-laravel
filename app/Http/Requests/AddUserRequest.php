<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddUserRequest extends FormRequest
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
        $id = $this->route('id') ?? NULL;
        return [
            'username' => 'required|string',
            'email' => 'required|email|unique:users,email'. ($id ? ','.$id : ''),
            'password' => ($id ? 'nullable' : 'required').'|min:5|max:10',
            'role' => 'required',
            'contact' => 'required|numeric|digits_between:11,13',
            'address' => 'string|required',
            'image' => ($id ? 'nullable' : 'required').'|mimes:png,jpg,jpeg',
            'status' => 'integer|required'
        ];
    }
}

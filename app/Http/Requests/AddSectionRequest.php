<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AddSectionRequest extends FormRequest
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
        $classId = $this->input('school_class_id');

        return [
            'name' => [
                'required',
                'string',
                Rule::unique('sections', 'name')
                ->where('school_class_id', $classId) 
                ->ignore($id) // 
            ],
            'school_class_id' => ($id ? 'nullable':'required').'|integer|exists:school_classes,id', 
        ];
    }
}

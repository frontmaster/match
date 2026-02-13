<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'project_title' => 'required|string|max:255',
            'project_type' => 'required|in:single,revenue',

            'price_min' => [
                'nullable',
                'integer',
                'min:1',
                'required_if:project_type, single',
            ],

            'price_max' => [
                'nullable',
                'integer',
                'min:1',
                'required_if:project_type, single',
                'gte:price_min',
            ],
            
            'content' => 'required|string|max:1000',
        ];
    }
}

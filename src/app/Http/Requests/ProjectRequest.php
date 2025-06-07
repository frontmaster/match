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
            'price' => $this->input('project_type') === 'single' ? 'required|integer|min:0' : 'nullable|integer|min:0', // 単発の場合のみ金額を必須にする
            'content' => 'required|string|max:1000',
        ];
    }
}

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
            'project_title' => 'required|string|max:30',
            'project_type' => 'required|in:single,revenue',

            'price_min' => [
                'nullable',
                'integer',
                'min:1',
            ],

            'price_max' => [
                'nullable',
                'integer',
                'min:1',
                'gte:price_min',
            ],

            'content' => 'required|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            // 案件名
            'project_title.required' => '案件名を入力してください。',
            'project_title.max' => '案件名は30文字以内で入力してください。',

            // 案件種別
            'project_type.required' => '案件種別を選択してください。',
            'project_type.in' => '案件',

            // 金額
            'price_min.required_if' => '金額の下限を入力してください。',
            'price_min.integer' => '金額の下限は整数で入力してください。',
            'price_min.min' => '金額の下限は1以上で入力してください。',

            'price_max.required_if' => '金額の上限を入力してください。',
            'price_max.integer' => '金額の上限は整数で入力してください。',
            'price_max.min' => '金額の上限は1以上で入力してください。',
            'price_max.gte' => '金額の上限は下限以上で入力してください。',

            // 内容
            'content_required' => '内容を入力してください。',
            'content_max' => '内容は1000文字以内で入力してください。',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $data = $this->all();
            $projectType = $data['project_type'] ?? null;

            if ($projectType === 'single') {
                $minEmpty = empty($data['price_min']);
                $maxEmpty = empty($data['price_max']);

                if ($minEmpty && $maxEmpty) {
                    $validator->errors()->add('price', '金額の下限と上限を入力してください。');
                    return;
                } else {
                    if ($minEmpty) {
                        $validator->errors()->add('price_min', '金額の下限を入力してください。');
                    }
                    if ($maxEmpty) {
                        $validator->errors()->add('price_max', '金額の上限を入力してください。');
                    }
                }
            }
        });
    }
}

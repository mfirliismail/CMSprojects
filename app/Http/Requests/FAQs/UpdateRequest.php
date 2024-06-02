<?php

namespace App\Http\Requests\FAQs;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'faqs_category_id' => ['required', 'integer', 'exists:faqs_categories,id'],
            'question' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string', 'max:255'],
        ];
    }
}

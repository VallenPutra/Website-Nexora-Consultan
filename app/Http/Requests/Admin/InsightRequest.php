<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class InsightRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'slug' => ['required', 'alpha_dash', 'max:150', 'unique:insights,slug,'.$this->route('insight')?->id],
            'category' => ['required', 'string', 'max:100'],
            'title' => ['required', 'string', 'max:255'],
            'excerpt' => ['required', 'string', 'max:1000'],
            'author' => ['required', 'string', 'max:255'],
            'published_at' => ['nullable', 'date'],
            'body' => ['nullable', 'string', 'max:50000'],
            'cover_image' => ['nullable', 'string', 'starts_with:media/'],
            'is_published' => ['sometimes', 'boolean'],
        ];
    }
}

<?php

namespace App\Http\Requests\Admin;

use App\Models\PortfolioItem;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PortfolioItemRequest extends FormRequest
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
            'name_id' => ['required', 'string', 'max:255'],
            'name_en' => ['required', 'string', 'max:255'],
            'work_id' => ['required', 'string', 'max:1000'],
            'work_en' => ['required', 'string', 'max:1000'],
            'category' => ['required', 'string', Rule::in(array_keys(PortfolioItem::CATEGORIES))],
            'image' => [$this->isMethod('POST') ? 'required' : 'nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:999'],
        ];
    }
}

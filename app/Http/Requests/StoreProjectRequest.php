<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\NoOffensiveContent;
class StoreProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role === 'client';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
        'title' => ['required', 'string', 'max:255', new NoOffensiveContent],
        'description' => ['required', 'string', 'min:50', new NoOffensiveContent],
        'budget_type' => ['required', 'in:fixed,hourly'],
        'deadline' => ['nullable', 'date', 'after:today'],
        'attachments' => ['nullable', 'array'],
        'tags' => ['nullable', 'array', 'max:5'],
        'tags.*' => ['exists:tags,id'],
    ];
    if ($this->budget_type === 'fixed') {
        $rules['budget_amount'] = ['required', 'numeric', 'min:100'];
    } else {
        $rules['budget_amount'] = ['required', 'numeric', 'min:10'];
    }

    return $rules;
    }
    protected function prepareForValidation()
    {
        $this->merge([
            'title' => trim($this->title),
            'description' => trim($this->description),
        ]);
    }
}

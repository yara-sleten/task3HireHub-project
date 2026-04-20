<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
       $project = $this->route('project');

           return auth()->check() &&
           auth()->user()->id === $project->client_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
        'title' => ['sometimes', 'string', 'max:255', new NoOffensiveContent],
        'description' => ['sometimes', 'string', 'min:50', new NoOffensiveContent],
        'budget_type' => ['sometimes', 'in:fixed,hourly'],
        'deadline' => ['nullable', 'date', 'after:today'],
        'tags' => ['sometimes', 'array', 'max:5'],
        'tags.*' => ['exists:tags,id'],
    ];

    if ($this->budget_type === 'fixed') {
        $rules['budget_amount'] = ['sometimes', 'numeric', 'min:100'];
    } else {
        $rules['budget_amount'] = ['sometimes', 'numeric', 'min:10'];
    }

    return $rules;
    }
}

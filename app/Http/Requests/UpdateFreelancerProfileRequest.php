<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateFreelancerProfileRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'bio' => 'sometimes|string',
            'hourly_rate' => 'sometimes|numeric',
            'phone' => 'sometimes|string',
            'avatar' => 'sometimes|string',
            'availability' => 'sometimes|in:available,busy,unavailable',
            'is_verified' => 'sometimes|boolean',
            'portfolio_url' => 'sometimes|nullable|string',
        ];
    }
}

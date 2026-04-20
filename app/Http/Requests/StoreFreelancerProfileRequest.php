<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreFreelancerProfileRequest extends FormRequest
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
             'user_id' => 'required|exists:users,id',
            'bio' => 'required|string',
            'hourly_rate' => 'required|numeric',
            'phone' => 'nullable|string',
            'avatar' => 'nullable|string',
            'availability' => 'in:available,busy,unavailable',
            'is_verified' => 'boolean',
            'portfolio_url' => 'nullable|string',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
class UpdateUserRequest extends FormRequest
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
            'name' => 'sometimes|string',
            'email' => 'sometimes|email|unique:users,email,' . Auth()->id(),
            'password' => 'sometimes|min:6',
            'phone' => 'sometimes|string',
            'role' => 'sometimes|in:client,freelancer,admin',
        ];
    }
}

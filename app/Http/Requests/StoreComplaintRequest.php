<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreComplaintRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'citizen_name' => 'required|string|max:255',
            'description' => 'required|string',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // جديد
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:png,jpg',
            'category_id' => 'required|numeric|exists:categories,id',
            'price' => 'required|numeric|regex:/^\d+(\.\d{1,6})?$/', // Allows up to 6 decimal places
            'stock' => 'required|numeric|min:0', // You can adjust the minimum as needed
        ];
    }
}

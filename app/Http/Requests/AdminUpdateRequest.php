<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;

class AdminUpdateRequest extends FormRequest
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
        // الحصول على معرف المستخدم من البيانات المرسلة في الطلب
        $userId = $this->input('id');

        return [
            'username' => ['required', 'string', 'max:255'],
            'id' => ['required', 'numeric', 'exists:users,id'],
            'phone' => ['required', 'max:255'],
            'rule' => ['required', 'in:admin,super_admin'],
            'address' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($userId)
            ],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ];
    }
}

<?php

namespace App\Http\Requests\Auth;

use App\Models\Employee;
use App\Rules\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class RegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'full_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', new PhoneNumber, 'unique:' . Employee::class],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . Employee::class],
            'password' => ['required', 'confirmed', Password::defaults()],
        ];
    }

    protected function prepareForValidation()
    {
        $phoneNumber = Str::replace(' ', '', $this->phone_number);
        $phoneNumber = preg_replace('/[-\+\(\)]+/', '', $phoneNumber);
        if ($phoneNumber[0] === '8') {
            $phoneNumber[0] = '7';
        }
        $this->merge([
            'phone_number' => $phoneNumber,
        ]);
    }
}

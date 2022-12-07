<?php

namespace App\Http\Requests;

use App\Models\Staff;
use App\Rules\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class CreateEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('add employee');
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
            'phone_number' => ['required', new PhoneNumber, 'unique:'.Staff::class],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Staff::class],
            'password' => ['required', 'confirmed', Password::defaults()],
        ];
    }
}

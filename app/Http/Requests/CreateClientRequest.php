<?php

namespace App\Http\Requests;

use App\Models\Client;
use App\Rules\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;

class CreateClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('add client');
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
            'phone_number' => ['required', new PhoneNumber, 'unique:'.Client::class],
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:'.Client::class],
        ];
    }
}

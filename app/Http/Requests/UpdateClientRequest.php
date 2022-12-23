<?php

namespace App\Http\Requests;

use App\Models\Client;
use App\Rules\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('update', Client::find($this->client_id));
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
            'phone_number' => ['nullable', new PhoneNumber, Rule::unique('clients')->ignore($this->client_id)],
            'email' => ['nullable', 'string', 'email', 'max:255', Rule::unique('clients')->ignore($this->client_id)],
        ];
    }
}

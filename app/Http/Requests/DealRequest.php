<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DealRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'deal_name' => 'required|string',
            'stage' => 'required|string',
            'account_name' => 'required|string',
            'website' => 'required|string',
            'phone' => 'required|string',
        ];
    }
}

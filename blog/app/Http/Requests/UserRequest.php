<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'full_name' => ['required', 'string', 'max:255'],
            'display_name' => ['string', 'max: 255'],
            'birthday' => ['date'],
            'phone_number' => ['required', 'regex:/^[0-9]{10}$/', 'unique:users,phone_number,' . Auth::user()->id],
            'address' => ['string', 'max: 255'],
            'email' => ['email:rfc,dns', 'unique:users,email,' . Auth::user()->id],
        ];
    }
}

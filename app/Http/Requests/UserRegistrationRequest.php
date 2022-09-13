<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegistrationRequest extends FormRequest
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
            'name' => ['required', 'max:191', 'string'],
            'email' => ['required', 'max:191', 'string', 'email', 'unique:users'],
            'password' => ['required', 'min:8', 'max:191', 'string', 'confirmed'],
        ];
    }
    public function messages()
    {
        return [
            'name.required' => config('const.REQUIRED'),
            'name.max' => config('const.OVER_MAX'),
            'name.string' => config('const.NOT_STRING'),
            'email.required' => config('const.REQUIRED'),
            'email.max' => config('const.OVER_MAX'),
            'email.string' => config('const.NOT_STRING'),
            'email.email' => config('const.NOT_EMAIL'),
            'email.unique' => config('const.NOT_UNIQUE'),
            'password.required' => config('const.REQUIRED'),
            'password.min' => config('const.UNDER_MIN'),
            'password.max' => config('const.OVER_MAX'),
            'password.string' => config('const.NOT_STRING'),
            'password.confirmed' => config('const.NOT_CONFIRMED'),
        ];
    }
}

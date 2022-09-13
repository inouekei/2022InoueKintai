<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PauseRequest extends FormRequest
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
            'attendance_id' => ['min:1', 'integer'],
            'start_time' => ['string', 'date_format:Y-m-d H:i:s'],
            'end_time' => ['string', 'date_format:Y-m-d H:i:s'],
            'mode' => ['string'],
        ];
    }
}

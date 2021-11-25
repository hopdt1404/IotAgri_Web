<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class AnalyticsDataAPIRequest extends FormRequest
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
            'PlotID' => 'nullable|numeric',
            'DeviceID' => 'nullable|numeric',
            'date' => 'nullable|date_format:Y-m-d'
        ];
    }
}

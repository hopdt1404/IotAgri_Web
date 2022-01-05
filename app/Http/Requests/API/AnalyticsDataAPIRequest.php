<?php

namespace App\Http\Requests\API;

use App\Http\Utils\AppUtils;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'FarmID' => 'nullable|numeric',
            'PlotID' => 'nullable|numeric',
            'DeviceID' => 'nullable|numeric',
            'date' => 'nullable|date_format:Y-m-d',
            'type' => [
                'nullable',
                Rule::in([
                    AppUtils::ANALYTIC_DATA_TYPE_SOIL_MOISTURE,
                    AppUtils::ANALYTIC_DATA_TYPE_TEMPERATURE,
                    AppUtils::ANALYTIC_DATA_TYPE_HUMIDITY,
                    AppUtils::ANALYTIC_DATA_TYPE_LIGHT_LEVEL,
                ])
            ]
        ];
    }
}

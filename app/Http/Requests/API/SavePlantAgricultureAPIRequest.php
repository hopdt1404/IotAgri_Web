<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class SavePlantAgricultureAPIRequest extends FormRequest
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
            'PlotID' => 'required|numeric',
            'plant_id' => 'required|numeric',
            'start_time_season' => 'required|date_format:Y-m-d',
            'end_time_season' => 'nullable|date_format:Y-m-d',
            'current_growth_day' => 'nullable|numeric',
            'current_plant_state' => 'nullable|numeric',
            'total_growth_day' => 'nullable|numeric',
            'status' => 'required|numeric',
        ];
    }
}

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
            'FarmID' => 'required|numeric',
            'plant_id' => 'required|numeric',
            'start_time_season' => 'required|date_format:Y-m-d H:i:s',
            'end_time_season' => 'nullable|date_format:Y-m-d H:i:s',
            'current_growth_day' => 'required|numeric',
            'current_plant_state' => 'required|numeric',
            'total_growth_day' => 'required|numeric',
            'status' => 'required|numeric',
        ];
    }
}

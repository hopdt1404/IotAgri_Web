<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class CreatePlantAPIRequest extends FormRequest
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
            'name' => 'required|string|max:50',
            'cultivars' => 'nullable',
            'plant_type_id' => 'nullable|numeric',
            'growth_period' => 'nullable',
            'planting_time' => 'nullable',
            'plant_density' => 'nullable',
            'width_bed' => 'nullable',
            'height_bed' => 'nullable',
            'row_spacing' => 'nullable',
            'tree_spacing' => 'nullable',
            'soil_type_id' => 'nullable|numeric',
            'info' => 'nullable',
        ];
    }
}

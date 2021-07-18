<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class CreatePlantStateInfoAPIRequest extends FormRequest
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
            'plant_state_id' => 'required|numeric',
            'plant_id' => 'required|numeric',
            'growth_period_state' => 'nullable|numeric',
            'temperature' => 'nullable|numeric',
            'moisture' => 'nullable|numeric',
            'light' => 'nullable|string',
            'note' => 'nullable|string',
        ];
    }
}

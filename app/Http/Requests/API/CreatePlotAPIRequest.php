<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class CreatePlotAPIRequest extends FormRequest
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
            'name' => 'required|string',
            'Area' => 'required|numeric|min:0',
            'FarmID' => 'required|numeric|min:0',
            'status' => 'required|numeric',
            'plant_id' => 'nullable|numeric|min:0'
        ];
    }
}

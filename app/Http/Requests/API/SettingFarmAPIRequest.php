<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class SettingFarmAPIRequest extends FormRequest
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
            'deviceIds' => 'nullable|array',
            'deviceIds.*' => 'nullable|numeric',
            'plantIds' => 'nullable|array',
            'plantIds.*' => 'nullable|numeric',
        ];
    }
}

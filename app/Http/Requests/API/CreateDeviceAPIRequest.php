<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class CreateDeviceAPIRequest extends FormRequest
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
            'DeviceName' => 'required|string|max:50',
            'DeviceTypeID' => 'nullable|numeric',
            'Status' => 'required|numeric',
            'PlotId' => 'nullable|numeric',
        ];
    }
}

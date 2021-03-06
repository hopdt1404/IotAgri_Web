<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class CreateFarmAPIRequest extends FormRequest
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
            'name' => 'required|string|max:128',
            'Area' => 'nullable|numeric',
            'Status' => 'required|numeric',
            'LocateID' => 'required|',
            'FarmTypeId' => 'required|numeric',
            'info' => 'nullable'
        ];
    }
}

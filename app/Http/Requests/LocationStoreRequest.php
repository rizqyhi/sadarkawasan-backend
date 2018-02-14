<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocationStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // @TODO: only moderator can create new location
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
            'type'         => 'required',
            'name'         => 'required',
            'location'     => 'required',
            'lat'          => 'required|numeric',
            'lng'          => 'required|numeric',
            'boundaries'   => 'nullable|json',
            'contacts'     => 'nullable|json',
            'data_sources' => 'nullable|json'
        ];
    }
}

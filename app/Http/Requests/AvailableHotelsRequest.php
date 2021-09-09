<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class AvailableHotelsRequest extends BaseApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'from_date' => 'required',
            'to_date'   =>  'required',
            'city'      =>  'required',
            'adults'    =>  'required',
            'api_providers' => [
                'array',
                Rule::in(config('hotels.available_providers'))
            ]
        ];
    }
}

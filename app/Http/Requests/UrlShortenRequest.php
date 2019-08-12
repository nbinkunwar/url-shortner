<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UrlShortenRequest extends FormRequest
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
            'long_url'=>'required|string|active_url|url',

        ];
    }
}

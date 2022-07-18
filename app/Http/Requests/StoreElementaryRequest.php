<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreElementaryRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required',
            'cell' => 'required|numeric',
            'k12fp_number' => 'required',
            'graduation_year' => 'required',
            'grade' => 'required',
            'school' => 'required',
            'parentName'=>'required',
            'parentEmail'=>'required',
            'parentCell'=>'required|numeric',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFrPagesRequest extends FormRequest
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
            'title' => 'required',
            'fundraiser' => 'sometimes|required',
            'student' => 'sometimes|required',
            'team' => 'required',
            'student_goal' => 'required',
            'content' => 'required',
            'featured_image' => 'sometimes|required',
            // 'featured_video' => 'sometimes|required',
        ];
    }
}

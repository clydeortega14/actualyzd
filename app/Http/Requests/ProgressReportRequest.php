<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProgressReportRequest extends FormRequest
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
            'main_concern' => ['required'],
            'initial_assessment' => ['required'],
            'followup_session' => ['required'],
            'has_prescription' => ['required'],
            'treatment_goal' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'has_prescription.required' => 'Please specify if the patient has medications / none'

        ];
    }
}

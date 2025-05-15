<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'clinic_id'   => 'required|array|min:1',
            'clinic_id.*' => 'exists:clinics,id',
            'start_time'  => 'required|date|before:end_time',
            'end_time'    => 'required|date|after:start_time',
        ];
    }

    public function messages(): array
    {
        return [
            'clinic_id.required'   => 'Please select at least one clinic.',
            'clinic_id.*.exists'   => 'The selected clinic is invalid.',
            'start_time.required'  => 'Start time is required.',
            'start_time.before'    => 'Start time must be before end time.',
            'end_time.required'    => 'End time is required.',
            'end_time.after'       => 'End time must be after start time.',
        ];
    }
}

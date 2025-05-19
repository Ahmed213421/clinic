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
        'doctor_id'   => 'required|exists:admins,id|min:1',
        'clinic_id'   => 'required|exists:clinics,id|min:1',
        'start_time'  => 'required|date|after_or_equal:now|before:end_time',
        'end_time'    => 'required|date|after:start_time',
    ];
}


    public function messages(): array
{
    return [
        'doctor_id.required'   => 'Please select at least one doctor.',
        'start_time.required'  => 'Start time is required.',
        'start_time.before'    => 'Start time must be before end time.',
        'start_time.after_or_equal' => 'Start time must not be in the past.',
        'end_time.required'    => 'End time is required.',
        'end_time.after'       => 'End time must be after start time.',
    ];
}

}

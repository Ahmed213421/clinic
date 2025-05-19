<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatedAppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'doctor_id'   => 'required|exists:admins,id|min:1',
            


        ];
    }

    public function messages(): array
    {
        return [
            'doctor_id.required'   => 'Please select at least one doctor.',
            'start_time.required'  => 'Start time is required.',
            'start_time.before'    => 'Start time must be before end time.',
            'end_time.required'    => 'End time is required.',
            'end_time.after'       => 'End time must be after start time.',
        ];
    }
}

<?php
namespace App\Http\Requests\Clinic;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'clinic_id' => ['required', 'exists:clinics,id'],
            'doctor_id' => ['required', 'exists:admins,id'],
            'appointment_id' => ['required', 'exists:appointments,id'],
            'phone' => ['required', 'string', 'regex:/^\+?[0-9\s\-\(\)]+$/'],
            
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'User is required.',
            'clinic_id.required' => 'Clinic selection is required.',
            'doctor_id.required' => 'Doctor selection is required.',
            'appointment_id.required' => 'Appointment selection is required.',
            'phone.required' => 'Phone number is required.',
            'phone.regex' => 'Phone number format is invalid.',
        ];
    }
}

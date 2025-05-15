<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClinicRequest extends FormRequest
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
            'name'    => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'phone'   => 'nullable|string|max:20',
            'doctor_id' => 'nullable|array|min:1',
            'doctor_id.*' => 'exists:doctors,id',
            'appointment_id' => 'nullable|array|min:1',
            'appointment_id.*' => 'exists:appointments,id',
        ];
    }
}

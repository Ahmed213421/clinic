<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'        => 'required|string|max:100',
            'password'        => 'required|string|max:100',
            'phone_number'      => 'required|string|max:15',
            'email'             => 'required|email|max:100|unique:doctors,email,' . $this->doctor,
            'specialization_id' => 'required|exists:specializations,id',
            'clinic_id'         => 'nullable|array|min:1',
            'clinic_id.*'       => 'exists:clinics,id',
        ];
    }
}

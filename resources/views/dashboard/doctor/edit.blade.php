<!-- Modal -->
<div class="modal fade" id="modaledit{{ $doctor->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.doctor.update', $doctor->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf

                    <div class="form-group">
                        <label for="specialization_id">Specialization</label>
                        <select class="custom-select" id="specialization_id" name="specialization_id" required>
                            <option disabled selected>Select Specialization</option>
                            @foreach (App\Models\Specialization::all() as $specialization)
                                <option value="{{ $specialization->id }}"
                                    {{ old('specialization_id', $doctor->specialization_id ?? '') == $specialization->id ? 'selected' : '' }}>
                                    {{ $specialization->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="clinic_id">{{ trans('dashboard.sel.clinic') }}</label>
                        <select class="custom-select" id="clinicselect" name="clinic_id[]" multiple required>
                            @foreach (App\Models\Clinic::all() as $clinic)
                                <option value="{{ $clinic->id }}"
                                    {{ collect(old('clinic_id', $doctor->clinics->pluck('id') ?? []))->contains($clinic->id) ? 'selected' : '' }}>
                                    {{ $clinic->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="appointment_id">{{ trans('dashboard.sel.appointment') }}</label>
                        <select class="custom-select" id="appointments" name="appointment_id" required>
                            <option selected disabled value="">{{ trans('dashboard.sel.appointment') }}</option>
                            @foreach (App\Models\Appointment::all() as $appointment)
                                <option value="{{ $appointment->id }}"
                                    {{ collect(old('appointment_id', $doctor->appointments->pluck('id') ?? []))->contains($appointment->id) ? 'selected' : '' }}>
                                    {{ $appointment->start_time }} To {{ $appointment->end_time }}
                                </option>
                            @endforeach
                        </select>
                    </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">{{ trans('dashboard.close') }}</button>
                <button type="submit" class="btn btn-primary">{{ trans('general.submit') }}</button>
            </div>
            </form>
        </div>
    </div>
</div>

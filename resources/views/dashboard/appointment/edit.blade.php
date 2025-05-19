<!-- Modal -->
<div class="modal fade" id="modaledit{{ $appointment->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if (auth('admin')->user()->hasRole('super-admin') || auth('admin')->user()->hasRole('super-admin'))
                    <form action="{{ route('admin.appointment.update', $appointment->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="clinic_id">Doctors</label>
                            <select class="custom-select" id="clinic_id" name="doctor_id">
                                <option disabled selected>Select doctor</option>
                                @foreach (App\Models\Admin::role('doctor')->get() as $doctor)
                                    <option value="{{ $doctor->id }}"
                                        {{ $doctor->id == $appointment->doctor->id ? 'selected' : '' }}>
                                        {{ $doctor->name }}</option>
                                @endforeach
                            </select>
                        </div>




                        <div class="form-group">
                            <label for="start_time">Start Time</label>
                            <input type="datetime-local" class="form-control" id="start_time" name="start_time"
                                value="{{ $appointment->start_time }}">
                        </div>

                        <div class="form-group">
                            <label for="end_time">End Time</label>
                            <input type="datetime-local" class="form-control" id="end_time" name="end_time"
                                value="{{ $appointment->end_time }}">
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ trans('dashboard.close') }}</button>
                            <button type="submit" class="btn btn-primary">{{ trans('general.submit') }}</button>
                        </div>
                    </form>
                @endif

                @if (auth('admin')->user()->hasRole('doctor') && $appointment->userApoointment?->id)
                    <form action="{{ route('admin.appointment.update', $appointment->userAppointment->id) }}"
                        method="POST">
                        @csrf

                        @method('PUT')
                        <input type="hidden" name="doctor_id" value="{{ $appointment->doctor->id }}">






                        <div class="form-group mb-3">
                            @php
                                $statuses = ['accepted', 'cancelled'];
                            @endphp
                            <label for="appointment_id">select status</label>
                            <select class="custom-select" id="appointments" name="status" required>
                                {{-- <option value="{{ $appointment->status }}" disabled selected>{{ ucfirst($appointment->status) }}</option> --}}
                                @foreach ($statuses as $status)
                                    @if ($statuses !== $appointment->status)
                                        <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>




                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ trans('dashboard.close') }}</button>
                            <button type="submit" class="btn btn-primary">{{ trans('general.submit') }}</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>

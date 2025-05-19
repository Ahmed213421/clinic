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
                <form action="{{ route('user.appointment.update', $appointment->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <!-- User (readonly input with Auth name) -->
                    <div class="form-group mb-3">
                        <label for="user_id">{{ trans('dashboard.user') }}</label>
                        <h6>{{ auth()->user()->name }}</h6>
                        <input type="hidden" id="user_id" class="form-control" name="user_id"
                            value="{{ auth()->user()->id }}" readonly>
                    </div>

                    <!-- Clinic -->


                    <div class="form-group mb-3">
                        @php
                            if ($appointment->status == 'accepted') {
                                $statuses = ['cancelled'];
                            } else {
                                $statuses = ['cancelled', 'pending'];
                            }
                        @endphp
                        <label for="appointment_id">select status</label>
                        <select class="custom-select" id="appointments" name="status" required>
                            {{-- <option value="{{ $appointment->status }}" selected>{{ ucfirst($appointment->status) }}</option> --}}
                            @foreach ($statuses as $status)
                                @if ($statuses !== $appointment->status)
                                    <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">{{ trans('general.submit') }}</button>
            </div>
            </form>
        </div>
    </div>
</div>

@section('js')
    <script>
        var currentLocale = '{{ app()->getLocale() }}';
        console.log(currentLocale);

        $('#dataTable-1').DataTable({
            "language": {
                "url": currentLocale === 'ar' ? 'https://cdn.datatables.net/plug-ins/2.2.1/i18n/ar.json' : ''
            },
            autoWidth: true,
            "lengthMenu": [
                [16, 32, 64, -1],
                [16, 32, 64, "All"]
            ]
        });
    </script>

    <script>
        function loadDoctors(clinicId, selectedDoctorId = null, selectedAppointmentId = null) {
            $('#doctors').empty().append('<option selected disabled>Select Doctor</option>').prop('disabled', true);
            $('#appointments').empty().append('<option selected disabled>Select Appointment</option>').prop('disabled',
                true);

            if (clinicId) {
                $.ajax({
                    url: '/select/' + clinicId + '/doctors',
                    method: 'GET',
                    success: function(doctors) {
                        $.each(doctors, function(index, doctor) {
                            let selected = (doctor.id == selectedDoctorId) ? 'selected' : '';
                            $('#doctors').append(
                                `<option value="${doctor.id}" ${selected}>${doctor.name} - ${doctor.specialization}</option>`
                                );
                        });

                        $('#doctors').prop('disabled', false);

                        if (selectedDoctorId) {
                            loadAppointments(clinicId, selectedDoctorId, selectedAppointmentId);
                        }
                    }
                });
            }
        }

        function loadAppointments(clinicId, doctorId, selectedAppointmentId = null) {
            $('#appointments').empty().append('<option selected disabled>Select Appointment</option>').prop('disabled',
                true);

            if (clinicId && doctorId) {
                $.ajax({
                    url: `/select/${clinicId}/doctor/${doctorId}/appointments`,
                    method: 'GET',
                    success: function(appointments) {
                        $.each(appointments, function(index, appointment) {
                            let selected = (appointment.id == selectedAppointmentId) ? 'selected' : '';
                            $('#appointments').append(
                                `<option value="${appointment.id}" ${selected}>${appointment.start_time} to ${appointment.end_time}</option>`
                            );
                        });
                        $('#appointments').prop('disabled', false);
                    }
                });
            }
        }

        $(document).ready(function() {
            let clinicId = $('#clinicselect').val();
            let selectedDoctorId = '{{ $appointment->doctor_id }}';
            let selectedAppointmentId = '{{ $appointment->id }}';

            // Initial load on page
            if (clinicId) {
                loadDoctors(clinicId, selectedDoctorId, selectedAppointmentId);
            }

            // When clinic changes
            $('#clinicselect').change(function() {
                let newClinicId = $(this).val();
                loadDoctors(newClinicId); // Reset selected doctor/appointment on change
            });

            // When doctor changes
            $('#doctors').change(function() {
                let newDoctorId = $(this).val();
                let currentClinicId = $('#clinicselect').val();
                loadAppointments(currentClinicId, newDoctorId);
            });
        });
    </script>
@endsection

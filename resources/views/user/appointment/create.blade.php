@extends('user.partials.master')

@section('title')
@endsection

@section('css')
@endsection


@section('breadcumb')
    <li class="breadcrumb-item"><a href="{{ route('user.home') }}">{{ trans('dashboard.home') }}</a></li>
@endsection

@section('breadcumbactive')
    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('user.appointment.create') }}">All
            Appointments</a></li>
@endsection

@section('content')
    <div class="bg-white p-4">
        @if (App\Models\Appointment::where('start_time', '>=', now())->where('end_time', '>', now())->where('booked', 0)->count() > 0)
            <h2 class="mb-2 page-title ms-4">Create Appointments</h2>
            <form action="{{ route('user.appointment.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')

                <div class="col-md-12">
                    <form action="{{ route('user.appointment.store') }}" method="POST">
                        @csrf
                        <!-- User (readonly input with Auth name) -->
                        <div class="form-group mb-3">
                            <label for="user_id">{{ trans('dashboard.user') }}</label>
                            <h6>{{ auth()->user()->name }}</h6>
                            <input type="hidden" id="user_id" class="form-control" name="user_id"
                                value="{{ auth()->user()->id }}" readonly>
                        </div>


                        <!-- Clinic -->
                        <div class="form-group mb-3">
                            <label for="clinic_id">{{ trans('dashboard.sel.clinic') }}</label>
                            <select class="custom-select" id="clinicselect" name="clinic_id">
                                <option selected disabled value="">{{ trans('dashboard.sel.clinic') }}</option>
                                @foreach (App\Models\Clinic::all() as $clinic)
                                    <option value="{{ $clinic->id }}">{{ $clinic->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Doctor -->
                        <div class="form-group mb-3">
                            <label for="doctor_id">{{ trans('dashboard.sel.doctor') }}</label>
                            <select class="custom-select" id="doctors" name="doctor_id">

                            </select>
                        </div>

                        <!-- Appointment -->
                        <div class="form-group mb-3">
                            <label for="appointment_id">{{ trans('dashboard.sel.appointment') }}</label>
                            <select class="custom-select" id="appointments" name="appointment_id">

                            </select>
                        </div>

                        <!-- Phone -->
                        <div class="form-group mb-3">
                            <label for="phone">{{ trans('dashboard.phone') }}</label>
                            <input type="text" id="phone" class="form-control" name="phone"
                                value="{{ old('phone') }}">
                        </div>

                        <button type="submit" class="btn btn-primary">{{ trans('general.submit') }}</button>
                </div>
            </form>
        @else
            <h2>no appointment available</h2>
        @endif

    </div>
@endsection

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

    {{-- <script>
    $(document).ready(function () {
        $('#clinicselect').change(function () {
            var clinicId = $(this).val();

            // Reset both dropdowns
            $('#doctors').empty()
                .append('<option selected disabled>Select Doctor</option>')
                .prop('disabled', true);

            $('#appointments').empty()
                .append('<option selected disabled>Select appointment</option>')
                .prop('disabled', true);

            if (clinicId) {
                // Fetch doctors
                $.ajax({
                    url: '/select/' + clinicId + '/doctors',
                    method: 'GET',
                    success: function (data) {
                        $.each(data, function (index, doctor) {
                            $('#doctors').append(
                                '<option value="' + doctor.id + '">' +
                                doctor.first_name + ' ' + doctor.specialization +
                                '</option>'
                            );
                        });
                        $('#doctors').prop('disabled', false);
                    },
                    error: function () {
                        alert('Failed to load doctors.');
                    }
                });

                // Fetch appointments
                $.ajax({
                    url: '/select/' + clinicId + '/appointment',
                    method: 'GET',
                    success: function (data) {
                        $.each(data, function (index, appointment) {
                            var isDisabled = appointment.booked ? 'selected' : '';
                            if (appointment.user_id == appointment.id) {
                                $('#appointments').append(
                                    '<option value="' + appointment.id + '" ' + isDisabled + '>' +
                                    appointment.start_time + ' to ' + appointment.end_time +
                                    '</option>'
                                );
}
                        });
                        $('#appointments').prop('disabled', false);
                    },
                    error: function () {
                        alert('Failed to load appointments.');
                    }
                });
            }
        });
    });
</script> --}}

    <script>
        let selectedClinicId = $('#clinicselect').val();
        let currentAppointmentId = '{{ $appointment->id ?? '' }}';

        $(document).ready(function() {
            // Load doctors on clinic change
            $('#clinicselect').change(function() {
                selectedClinicId = $(this).val();

                // Reset both dropdowns
                $('#doctors').empty()
                    .append('<option selected disabled>Select Doctor</option>')
                    .prop('disabled', true);

                $('#appointments').empty()
                    .append('<option selected disabled>Select Appointment</option>')
                    .prop('disabled', true);

                if (selectedClinicId) {
                    $.ajax({
                        url: '/select/' + selectedClinicId + '/doctors',
                        method: 'GET',
                        success: function(data) {
                            if (data.length === 0) {
                                alert('No doctors found for this clinic');
                                return;
                            }

                            $.each(data, function(index, doctor) {
                                let selected = (doctor.id ==
                                        '{{ $appointment->doctor_id ?? '' }}') ?
                                    'selected' : '';
                                $('#doctors').append(
                                    `<option value="${doctor.id}" ${selected}>${doctor.name}</option>`
                                );
                            });

                            $('#doctors').prop('disabled', false);

                            // Trigger appointment loading if editing
                            if ('{{ $appointment->doctor_id ?? '' }}') {
                                $('#doctors').trigger('change');
                            }
                        },
                        error: function() {
                            alert('Failed to load doctors.');
                        }
                    });
                }
            });

            // Load appointments on doctor change
            $('#doctors').change(function() {
                let doctorId = $(this).val();

                $('#appointments').empty()
                    .append('<option selected disabled>Select Appointment</option>')
                    .prop('disabled', true);

                if (doctorId && selectedClinicId) {
                    $.ajax({
                        url: `/select/${selectedClinicId}/doctor/${doctorId}/appointments?current_appointment_id=${currentAppointmentId}`,
                        method: 'GET',
                        success: function(data) {
                            if (data.length === 0) {
                                alert('No appointments found for this doctor in this clinic');
                                return;
                            }

                            $.each(data, function(index, appointment) {
                                let isSelected = appointment.id ==
                                    currentAppointmentId ? 'selected' : '';
                                let isBooked = appointment.booked && !isSelected ?
                                    'disabled' : '';

                                $('#appointments').append(
                                    `<option value="${appointment.id}" ${isSelected} ${isBooked}>${appointment.start_time} to ${appointment.end_time}${isBooked ? ' (Booked)' : ''}</option>`
                                );
                            });

                            $('#appointments').prop('disabled', false);
                        },
                        error: function() {
                            alert('Failed to load appointments.');
                        }
                    });
                }
            });

            // Auto-trigger on page load for edit
            if (selectedClinicId) {
                $('#clinicselect').trigger('change');
            }
        });
    </script>
@endsection

<!-- Modal -->
<div class="modal fade" id="modaledit{{$appointment->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin.appointment.update',$appointment->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="form-group">
                    <label for="name">{{ trans('dashboard.name') }}</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $appointment->name}}">
                </div>
                <div class="form-group">
                    <label for="name">{{ trans('general.phone') }}</label>
                    <input type="text" class="form-control" id="name" name="phone" value="{{ $appointment->phone}}">
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


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('dashboard.close') }}</button>
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

        $('#dataTable-1').DataTable(
        {
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
                            $('#appointments').append(
                                '<option value="' + appointment.id + '" ' + isDisabled + '>' +
                                appointment.start_time + ' to ' + appointment.end_time +
                                (appointment.booked ? ' (Booked)' : '') +
                                '</option>'
                            );
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
</script>


@endsection


@extends('dashboard.partials.master')

@section('title')
@endsection

@section('css')
@endsection


@section('breadcumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ trans('dashboard.home') }}</a></li>
@endsection

@section('breadcumbactive')
    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.appointment.index') }}">All
            Appointments</a></li>
@endsection

@section('content')
    <div class="bg-white p-4">
        <h2 class="mb-2 page-title ms-4">All Appointments</h2>

        <div class="bg-white p-4">

            @if (auth('admin')->user()->can('create-appointment'))
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2">
                    create new appointment
                </button>
            @endif

            <div class="row">
                <div class="col-sm-6 col-md-12 overflow-auto">
                    <table class="table datatables dataTable no-footer w-100" id="dataTable-1" role="grid"
                        aria-describedby="dataTable-1_info">
                        <thead>
                            <tr role="row">
                                <td>#</th>
                                <td>start time</td>
                                <td>end time</td>

                                <td>doctor</td>
                                <td>clinic</td>
                                @if (auth('admin')->user()->hasRole('doctor'))
                                    <td>status</td>
                                @endif
                                <td>{{ trans('dashboard.actions') }}</td>
                            </tr>

                        </thead>
                        <tbody>
                            @if (auth('admin')->user()->hasRole('super-admin') || auth('admin')->user()->hasRole('super-admin'))
                                @foreach ($Appointments as $appointment)
                                    <tr role="row" class="even">
                                        </td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $appointment->start_time }}</td>
                                        <td>{{ $appointment->end_time }}</td>

                                        <td>
                                            {{ $appointment->doctor->name }}
                                        </td>

                                        <td>
                                            {{ $appointment->clinic?->name }}

                                        </td>

                                        <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="text-muted sr-only">{{ trans('dashboard.actions') }}</span>
                                            </button>

                                            <div class="dropdown-menu dropdown-menu-right">
                                                @if (auth('admin')->user()->can('create-appointment'))
                                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                                        data-target="#modal{{ $appointment->id }}">
                                                        {{ trans('dashboard.delete') }}
                                                    </a>
                                                @endif
                                                @if (auth('admin')->user()->can('edit-appointment'))
                                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                                        data-target="#modaledit{{ $appointment->id }}">
                                                        {{ trans('dashboard.edit') }}
                                                    </a>
                                                @endif
                                        </td>
                </div>
                </tr>
                @include('dashboard.appointment.delete')
                @include('dashboard.appointment.edit')
                {{-- @include('dashboard.clinic.edit') --}}
                @endforeach
                @endif

                @if (auth('admin')->user()->hasRole('doctor'))
                    @php
                        $doctorId = auth('admin')->user()->id;
                    @endphp
                    @foreach (App\Models\Appointment::where('doctor_id', $doctorId)->get() as $appointment)
                        <tr role="row" class="even">
                            </td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $appointment->start_time }}</td>
                            <td>{{ $appointment->end_time }}</td>
                            <td>
                                {{ $appointment->userAppointment?->user->name }}

                            </td>

                            <td>
                                {{ $appointment->clinic?->name }}

                            </td>
                            <td>
                                {{ $appointment->doctor->name }}
                            </td>
                            <td>{{ $appointment->userAppointment?->status }}</td>
                            <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="text-muted sr-only">{{ trans('dashboard.actions') }}</span>
                                </button>

                                <div class="dropdown-menu dropdown-menu-right">
                                    @if (auth('admin')->user()->can('create-appointment'))
                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                            data-target="#modal{{ $appointment->id }}">
                                            {{ trans('dashboard.delete') }}
                                        </a>
                                    @endif
                                    {{-- @if (auth('admin')->user()->can('edit-appointment')) --}}

                                    @if (
                                        $appointment->userAppointment?->status == 'cancelled' &&
                                            $appointment->userAppointment?->cancellled_by_type == 'App\Models\User')
                                    @elseif($appointment->userAppointment?->status == 'pending')
                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                            data-target="#modaledit{{ $appointment->id }}">
                                            {{ trans('dashboard.edit') }}
                                        </a>
                                    @elseif(
                                        $appointment->userAppointment?->status == 'cancelled' &&
                                            $appointment->userAppointment?->cancelled_by_type != 'App\Models\User')
                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                            data-target="#modaledit{{ $appointment->id }}">
                                            {{ trans('dashboard.edit') }}
                                        </a>
                                    @endif
                                    {{-- @endif --}}
                            </td>
            </div>
            </tr>
            @include('dashboard.appointment.delete')
            @include('dashboard.appointment.edit')
            {{-- @include('dashboard.clinic.edit') --}}
            @endforeach
            @endif
            </tbody>
            <table>
        </div>
    </div>
    <!-- simple table -->
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.clinic.store') }}" method="POST" enctype="multipart/form-data">
                        @method('POST')
                        @csrf

                        <div class="form-group">
                            <label for="name">name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>

                        <div class="form-group">
                            <label for="address">address</label>
                            <input type="text" class="form-control" id="address" name="address">
                        </div>
                        <div class="form-group">
                            <label for="phone">phone</label>
                            <input type="text" class="form-control" id="phone" name="phone">
                        </div>

                        <div class="form-group mb-3">
                            <label for="custom-select">select appointment</label>
                            <select class="custom-select" id="categoryselect" name="appointment_id[]" multiple>
                                <option selected disabled value="">select appointment</option>
                                @foreach (App\Models\Appointment::all() as $appointment)
                                    <option value="{{ $appointment->id }}">{{ $appointment->start_time }} to
                                        {{ $appointment->end_time }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="custom-select">select doctors</label>
                            <select class="custom-select" id="categoryselect" name="doctor_id[]" multiple>
                                <option selected disabled value="">select doctors</option>
                                @foreach (App\Models\Admin::role('doctor')->get() as $doctor)
                                    <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                @endforeach
                            </select>
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
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.appointment.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="clinic_id">Doctors</label>
                            <select class="custom-select" id="clinic_id" name="doctor_id">
                                <option disabled selected>Select doctor</option>
                                @foreach (App\Models\Admin::role('doctor')->get() as $doctor)
                                    <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                @endforeach
                            </select>
                        </div>




                        <div class="form-group">
                            <label for="start_time">Start Time</label>
                            <input type="datetime-local" class="form-control" id="start_time" name="start_time">
                        </div>

                        <div class="form-group">
                            <label for="end_time">End Time</label>
                            <input type="datetime-local" class="form-control" id="end_time" name="end_time">
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
@endsection

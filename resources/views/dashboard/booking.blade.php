@extends('dashboard.partials.master')

@section('title')
@endsection

@section('css')
@endsection


@section('breadcumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ trans('dashboard.home') }}</a></li>
@endsection

@section('breadcumbactive')
    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.booked') }}">All Bookings</a></li>
@endsection

@section('content')
    <div class="bg-white p-4">

        <div class="bg-white px-1">
            <h2 class="mb-2 page-title">All Bookings</h2>

            {{-- @if (auth('admin')->user()->can('create-doctor'))
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            create new doctor
        </button>
         @endif --}}

            <div class="row">
                <div class="col-sm-6 col-md-12 overflow-auto">
                    <table class="table datatables dataTable no-footer w-100" id="dataTable-1" role="grid"
                        aria-describedby="dataTable-1_info">
                        <thead>
                            <tr role="row">
                                <td>#</th>
                                <td>start time</td>
                                <td>end time</td>
                                <td>patients</td>
                                <td>clinic</td>
                                <td>doctor</td>
                                <td>status</td>
                                <td>Is Booked?</td>
                            </tr>

                        </thead>
                        <tbody>

                            @foreach (App\Models\Appointment::get() as $appointment)
                                <tr role="row" class="even">
                                    </td>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $appointment->start_time }}</td>
                                    <td>{{ $appointment->end_time }}</td>
                                    <td>
                                        {{ $appointment->userAppointment?->user?->name }}
                                    </td>
                                    <td>
                                        {{ $appointment->doctor->name }}
                                    </td>
                                    <td>
                                        {{ $appointment->clinic?->name }}

                                    </td>
                                    <td>
                                        {{ $appointment->userAppointment?->status }} By
                                        @if ($appointment->userAppointment?->cancelled_by_type == 'App\Models\User')
                                            patient
                                        @else
                                            doctor
                                        @endif

                                    </td>
                                    <td>
                                        {{ $appointment->booked == 1 ? 'Yes' : 'No' }}
                                    </td>


                </div>
                </tr>
                {{-- @include('dashboard.clinic.edit') --}}
                @endforeach
                </tbody>
                <table>
            </div>
        </div>
    </div>
    </div>
    <!-- simple table -->
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

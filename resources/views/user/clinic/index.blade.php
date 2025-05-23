@extends('dashboard.partials.master')

@section('title')
@endsection

@section('css')
@endsection


@section('breadcumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ trans('dashboard.home') }}</a></li>
@endsection

@section('breadcumbactive')
<li class="breadcrumb-item active" aria-current="page"><a
href="{{ route('admin.clinic.index') }}">All Cinic</a></li>
@endsection

@section('content')
<div class="bg-white p-4">
<h2 class="mb-2 page-title ms-4">All Clinics</h2>

<div class="bg-white p-4">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            create new clinic
        </button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2">
            create new appointment
        </button>

                <div class="row">
                    <div class="col-sm-6 col-md-12 overflow-auto">
                        <table class="table datatables dataTable no-footer w-100" id="dataTable-1"
                            role="grid" aria-describedby="dataTable-1_info">
                            <thead>
                                <tr role="row">
                                    <td>#</th>
                                    <td>{{ trans('dashboard.name') }}</td>
                                    <td>{{ trans('general.address') }}</td>
                                    <td>{{ trans('general.phone') }}</td>
                                    <td>appointment</td>
                                    <td>{{ trans('dashboard.actions') }}</td>
                                </tr>

                            </thead>
                            <tbody>
                                @foreach ($clinics as $clinic)
                                <tr role="row" class="even">
                                        </td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $clinic->name }}</td>
                                        <td>{{ $clinic->address }}</td>
                                        <td>{{ $clinic->phone }}</td>
                                        <td>
                                        @forelse ($clinic->appointments as $appointment)
                                            {{ $appointment->start_time }} to {{ $appointment->end_time }} -- {{$appointment->status}}<br>
                                            @empty
                                            no appointments
                                        @endforelse
                                        </td>
                                        <td><button class="btn btn-sm dropdown-toggle more-horizontal"
                                                type="button" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <span
                                                    class="text-muted sr-only">{{ trans('dashboard.actions') }}</span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                    data-target="#modal{{ $clinic->id }}">
                                                    {{ trans('dashboard.delete') }}
                                                </a>
                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                    data-target="#modaledit{{ $clinic->id }}">
                                                    {{ trans('dashboard.edit') }}
                                                </a>
                                            </div>
                                        </td>
                                </tr>
                                {{-- @include('dashboard.clinic.delete') --}}
                                {{-- @include('dashboard.clinic.edit') --}}
                                @endforeach
                            </tbody>
                        <table>
                    </div>
                </div>
             <!-- simple table -->

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
                                    <label for="clinic_id">Clinic</label>
                                    <select class="custom-select" id="clinic_id" name="clinic_id[]" multiple>
                                        <option disabled selected>Select Clinic</option>
                                        @foreach (App\Models\Clinic::all() as $clinic)
                                            <option value="{{ $clinic->id }}">{{ $clinic->name }}</option>
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
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('dashboard.close') }}</button>
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

@endsection

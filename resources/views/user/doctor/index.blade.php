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
href="{{ route('admin.clinic.index') }}">All Doctors</a></li>
@endsection

@section('content')
<div class="bg-white p-4">

    <div class="bg-white px-1">
    <h2 class="mb-2 page-title">List of Doctors</h2>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            create new doctor
        </button>

                <div class="row">
                    <div class="col-sm-6 col-md-12 overflow-auto">
                        <table class="table datatables dataTable no-footer w-100" id="dataTable-1"
                            role="grid" aria-describedby="dataTable-1_info">
                            <thead>
                                <tr role="row">
                                    <td>#</th>
                                    <td>first name</td>
                                    <td>last name</td>
                                    <td>{{ trans('general.phone') }}</td>
                                    <td>email</td>
                                    <td>specialization</td>
                                    <td>clinic</td>
                                    <td>{{ trans('dashboard.actions') }}</td>
                                </tr>

                            </thead>
                            <tbody>
                                @foreach ($doctors as $doctor)
                                <tr role="row" class="even">
                                        </td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $doctor->first_name }}</td>
                                        <td>{{ $doctor->last_name }}</td>
                                        <td>{{ $doctor->phone_number }}</td>
                                        <td>{{ $doctor->email }}</td>
                                        <td>{{ $doctor->specialization->name }}</td>
                                        <td>
                                        @forelse ($doctor->clinics as $clinic)
                                            {{ $clinic->name }}<br>
                                            @empty
                                            no clinics
                                        @endforelse
                                        <td>
                                        <td><button class="btn btn-sm dropdown-toggle more-horizontal"
                                                type="button" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <span
                                                    class="text-muted sr-only">{{ trans('dashboard.actions') }}</span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                    data-target="#modal{{ $doctor->id }}">
                                                    {{ trans('dashboard.delete') }}
                                                </a>
                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                    data-target="#modaledit{{ $doctor->id }}">
                                                    {{ trans('dashboard.edit') }}
                                                </a>
                                            </div>
                                        </td>
                                </tr>
                                @include('dashboard.doctor.delete')
                                @include('dashboard.doctor.edit')
                                @endforeach
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
                            <form action="{{ route('admin.doctor.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name">
                                </div>

                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name">
                                </div>

                                <div class="form-group">
                                    <label for="clinic_id">Specialization</label>
                                    <select class="custom-select" id="clinic_id" name="specialization_id">
                                        <option disabled selected>Select Specialization</option>
                                        @foreach (App\Models\Specialization::all() as $specialization)
                                            <option value="{{ $specialization->id }}">{{ $specialization->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="phone_number">Phone Number</label>
                                    <input type="text" class="form-control" id="phone_number" name="phone_number">
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>

                                <div class="form-group">
                                    <label for="clinic_id">Select Clinic</label>
                                    <select class="custom-select" id="clinic_id" name="clinic_id[]" multiple>
                                        <option selected disabled value="">Select clinic</option>
                                        @foreach (App\Models\Clinic::all() as $clinic)
                                            <option value="{{ $clinic->id }}">{{ $clinic->name }}</option>
                                        @endforeach
                                    </select>
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

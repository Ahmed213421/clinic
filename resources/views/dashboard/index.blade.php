@extends('dashboard.partials.master')

@section('title')
@endsection

@section('css')
@endsection

@section('titlepage')
@endsection

@section('breadcumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ trans('dashboard.home') }}</a></li>
@endsection

@section('breadcumbactive')
    <li class="breadcrumb-item active" aria-current="page"></li>
@endsection

@section('content')
    <div class="bg-white p-4">
        <h2 class="mb-2 page-title">{{ trans('general.welcome') }} {{ auth('admin')->user()->name }}</h2>

        <div class="container my-5">
            <h2 class="mb-4">Doctors, Clinics & Appointments</h2>

            <!-- Loop over doctors -->
            <div class="mb-5">
                {{-- <h4 class="text-primary">Dr. John Doe</h4> --}}

                <!-- Loop over clinics -->
                <div class="card mb-3" style="max-height: 400px;overflow-y:scroll">
                    @foreach (App\Models\Clinic::all() as $clinic)
                        <div class="card-header bg-info text-white mt-5">
                            <strong>{{ $clinic->name }}</strong><br>
                            {{-- @foreach ($clinic->appointments as $appointment)
        <strong>{{$appointment->start_time}} To {{$appointment->end_time}}</strong><br>
        @endforeach --}}
                            {{-- <br><small>123 Main St, New York, NY</small> --}}
                        </div>
                        <div class="card-body mt">
                            <h6 class="text-muted mb-3">Doctors</h6>

                            <!-- Loop over appointments -->
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        @foreach ($clinic->doctors as $doctor)
                                            <strong>{{ $doctor->name }} -- {{ $doctor->specialization->name }}</strong><br>
                                        @endforeach
                                        {{-- <small>10:30 AM - Checkup</small> --}}
                                    </div>
                                    {{-- <span class="badge badge-success">Confirmed</span> --}}
                                </li>

                            </ul>
                        </div><br>
                    @endforeach
                </div>


            </div>


        </div>



        <!-- End Counter -->



    </div>
@endsection

@section('js')
@endsection

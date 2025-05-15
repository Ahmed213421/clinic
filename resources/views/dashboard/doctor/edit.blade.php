<!-- Modal -->
<div class="modal fade" id="modaledit{{$doctor->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin.doctor.update',$doctor->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="form-group">
                    <label for="name">first name</label>
                    <input type="text" class="form-control" id="name" name="first_name" value="{{ $doctor->first_name}}">
                </div>
                <div class="form-group">
                    <label for="name">last name</label>
                    <input type="text" class="form-control" id="name" name="last_name" value="{{ $doctor->last_name}}">
                </div>
                <div class="form-group">
                    <label for="name">{{ trans('general.phone') }}</label>
                    <input type="text" class="form-control" id="name" name="phone" value="{{ $doctor->phone}}">
                </div>
                <div class="form-group">
                    <label for="name">{{ trans('general.email') }}</label>
                    <input type="email" class="form-control" id="name" name="email" value="{{ $doctor->email}}">
                </div>

                <div class="form-group">
                    <label for="clinic_id">Specialization</label>
                    <select class="custom-select" id="clinic_id" name="specialization_id">
                        <option disabled selected>Select Specialization</option>
                        @foreach (App\Models\Specialization::all() as $specialization)
                            <option value="{{ $specialization->id }}" {{$specialization->id == $doctor->clinics->contains($specialization->id) ? 'selected':"" }}>{{ $specialization->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                                    <label for="custom-select">select appointment</label>
                                    <select class="custom-select" id="categoryselect" name="appointment_id">
                                        <option selected disabled value="">select appointment</option>
                                        @foreach (App\Models\Appointment::all() as $appointment)
                                        <option value="{{$appointment->id}}">{{$appointment->start_time}} to {{$appointment->end_time}}</option>

                                        @endforeach
                                    </select>
                                </div>

                                 <div class="form-group mb-3">
                                    <label for="custom-select">select doctors</label>
                                    <select class="custom-select" id="categoryselect" name="doctor_id[]" multiple>
                                        <option selected disabled value="">select doctors</option>
                                        @foreach (App\Models\Doctor::all() as $doctor)
                                        <option value="{{$doctor->id}}">{{$doctor->name}}</option>

                                        @endforeach
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

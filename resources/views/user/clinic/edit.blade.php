<!-- Modal -->
<div class="modal fade" id="modaledit{{$clinic->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin.clinic.update',$clinic->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="form-group">
                    <label for="name">{{ trans('dashboard.name') }}</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $clinic->name}}">
                </div>
                <div class="form-group">
                    <label for="name">{{ trans('general.phone') }}</label>
                    <input type="text" class="form-control" id="name" name="phone" value="{{ $clinic->phone}}">
                </div>
                <div class="form-group">
                    <label for="name">{{ trans('general.address') }}</label>
                    <input type="text" class="form-control" id="name" name="address" value="{{ $clinic->address}}">
                </div>

                <div class="form-group mb-3">
                                    <label for="custom-select">select appointment</label>
                                    <select class="custom-select" id="categoryselect" name="appointment_id[]" multiple>
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
                                            <option value="{{$doctor->id}}" {{$doctor->id == $clinic->doctors->contains($doctor->id) ? 'selected':"" }}>{{$doctor->name}}</option>
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

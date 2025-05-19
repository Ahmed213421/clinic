<!-- Modal -->
<div class="modal fade" id="modal{{$appointment->id}}" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{$appointment->id}}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel{{$appointment->id}}">{{ trans('dashboard.delete_confirm') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.appointment.destroy', $appointment->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <div class="form-group">
                        <label for="name">{{ trans('dashboard.del.item') }}</label>
                        <input type="text" class="form-control" id="name" disabled value="{{ $appointment->start_time}} To {{$appointment->end_time}}">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('dashboard.close') }}</button>
                        <button type="submit" class="btn btn-danger">{{ trans('dashboard.delete') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="create-schedule" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">Create / Update Schedule</h4>
                <div style="display: none;" id="div-delete">
                    <a href="javascript:void(0);" class="btn btn-danger btn-sm" onclick="event.preventDefault(); document.getElementById('delete-form').submit();">Delete</a>
                    <form id="delete-form" action="{{ route('psychologist.delete.schedule') }}" method="POST" style="display: none;">
                        @csrf
                        <input type="text" name="sched_id" value="" class="sched-id">
                    </form>
                </div>
            </div>
            <form action="{{ route('psychologist.store.schedule') }}" method="POST">
                @csrf
                <div class="modal-body">

                    
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="start-date">Date</label>
                            <div class="form-line">
                                <input type="date" name="start_date" id="start-date" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label>Time Lists</label>
                            @foreach($time_lists as $time)
                                <div class="form-group">
                                    <input type="checkbox" id="time{{$time->id}}" name="time_lists[]" value="{{ $time->id }}"/>
                                    <label for="time{{$time->id}}">{{ $time->parseTimeFrom().' - '.$time->parseTimeTo() }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    {{-- <input type="hidden" name="sched_id" value="" class="sched-id">

                    <label for="title">Title</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title">
                        </div>
                    </div>

                    <label for="start">Start Date & Time</label>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <div class="form-line">
                                <input type="date" name="start_date" id="start-date" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-line">
                                <input type="time" name="start_time" id="start-time" class="form-control" placeholder="Start Time">
                            </div>
                        </div>
                    </div>

                    <label for="end">End Date & Time</label>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <div class="form-line">
                                <input type="date" name="end_date" id="end-date" class="form-control" placeholder="End Date">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-line">
                                <input type="time" name="end_time" id="end-time" class="form-control" placeholder="End Time">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="checkbox" id="allDay" name="allDay" />
                        <label for="allDay">All Day</label>
                    </div> --}}

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary waves-effect">Submit</button>
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
                </div>
            </form>
        </div>
    </div>
</div>
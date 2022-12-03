<div class="modal fade" id="create-schedule" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="create-schedule-modal-label">Create / Update Schedule</h4>
                <hr>
            </div>

            <form action="{{ route('psychologist.store.schedule') }}" method="POST">
                @csrf
                <div class="modal-body">

                    <input type="hidden" name="start_date" class="form-control start-date" readonly>
                    <input type="hidden" name="end_date" class="form-control" readonly>


                    <div class="row">
                        <div class="col-md-3">
                            <h3 class="mb-3">Time lists</h3>
                            <div id="schedules-time-lists"></div>
                        </div>
                        <div class="col-md-9">
                            <div class="table-responsive">
                                <h3 class="mb-3">Schedule Details</h3>

                                @if(auth()->user()->hasRole('superadmin'))
                                    <div class="form-group">
                                        <label>By Psychologists</label>
                                        <select class="custom-select" id="select-psychologist">
                                            <option disabled selected> select psychologist</option>
                                            @foreach($psychologists as $psych)
                                                <option value="{{ $psych->id }}">{{ $psych->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif

                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Time</th>
                                            <th>Status</th>
                                            <th>Type</th>
                                            <th>Participant/s</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="schedules-table"></tbody>
                                </table>

                               
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary waves-effect">Submit</button>
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
                </div>
            </form>
            
        </div>
    </div>
</div>
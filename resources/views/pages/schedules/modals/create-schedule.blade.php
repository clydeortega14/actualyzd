<div class="modal fade" id="create-schedule" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">Create Your Schedule Now!</h4>
            </div>
            <form action="{{ route('psychologist.store.schedule') }}" method="POST">
                @csrf
                <div class="modal-body">
                    
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
                        <div class="demo-checkbox">
                            <input type="checkbox" id="allDay" name="allDay" />
                            <label for="allDay">All Day</label>
                        </div>
                    </div>

                    <label for="color">Background Color</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="color" name="color" id="color" class="form-control">
                        </div>
                    </div>

                    <label for="textColor">Text Color</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="color" name="textColor" id="textColor" class="form-control">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary waves-effect">CREATE SCHEDULE</button>
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
                </div>
            </form>
        </div>
    </div>
</div>
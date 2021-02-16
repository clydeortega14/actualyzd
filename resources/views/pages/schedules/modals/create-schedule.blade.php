<div class="modal fade" id="create-schedule" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">Create Your Schedule Now!</h4>
            </div>
            <form>
                <div class="modal-body">
                    
                    <label for="title">Title</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title">
                        </div>
                    </div>

                    <label for="start">Start</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="start" id="start" class="datetimepicker form-control" placeholder="Start Date & Time">
                        </div>
                    </div>

                    <label for="end">End</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="end" id="end" class="datetimepicker form-control" placeholder="End Date & Time">
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
                    <button type="button" class="btn btn-primary waves-effect">CREATE SCHEDULE</button>
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
                </div>
            </form>
        </div>
    </div>
</div>
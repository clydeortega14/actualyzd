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
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border-right: 1px solid gray;">
                            <h3>Time Lists</h3>
                            <div class="row" id="schedules-time-lists"></div>
                            <hr>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            
                            <div class="table-responsive">
                                <h3>Schedule Details</h3>
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Time</th>
                                            <th>Book With</th>
                                            <th>Status</th>
                                            <th>Action</th>
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
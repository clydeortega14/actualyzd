<div class="modal fade" id="create-schedule" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="create-schedule-modal-label">Create / Update Schedule</h4>
                <hr>
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

{{-- 
            <form action="{{ route('book.now') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <h4 class="text-center">Book Now</h4>
                    <hr>

                    <input type="hidden" name="start_date" class="form-control start-date" readonly>

                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12" style="border-right: 1px solid gray;">
                            <label>Time Lists</label>
                            <div id="counseling-time-lists"></div>
                        </div>

                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                            <label>Psychologists</label>
                            <div class="row clearfix" id="psychologist-available"></div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary waves-effect">Book Now</button>
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancel</button>
                </div>
            </form> --}}
        </div>
    </div>
</div>
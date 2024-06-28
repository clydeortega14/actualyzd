<div class="modal fade" id="pending-{{ $pending->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="create-schedule-modal-label">Reassigning Session</h4>
                <hr>
            </div>

            <div class="form-group row mt-3">
                <label for="assignee" class="col-form-label text-md-right col-sm-3">Assignee</label>
                <div class="col-sm-8">
                    <select name="assignee" id="assignee" class="form-control">
                        <option disabled selected> - Select Assignee - </option>
                    </select>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary waves-effect">Submit</button>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
            
            
        </div>
    </div>
</div>
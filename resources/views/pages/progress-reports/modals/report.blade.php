<div class="modal fade" id="report-{{ $report->id }}" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
                <h4 class="modal-title" id="create-schedule-modal-label">Reports</h4>
                <hr>
            </div>

            <div class="modal-body">

                 <report-assignee report-id="{{ $report->id }}" report-assignee="{{ is_null($report->assignee) ? 'No Assignee' : $report->toAssignee->name }}"></report-assignee>

            	<ol type="I">
            		<li class="mb-3">
            			<h6>Main Concern</h6>
            			<div>
            				<p>{{ $report->main_concern}}</p>
            			</div>
            		</li>

            		<li class="mb-3">
            			<h6>Has Prescriptions?</h6>
            			<div>
            				<p>{{ $report->has_prescription ? 'Yes' : 'No'}}</p>
            			</div>
            		</li>

            		<li class="mb-3">
            			<h6>Ininital Assessment</h6>
            			<div>
            				<p>{{ $report->initial_assessment }}</p>
            			</div>
            		</li>

            		<li class="mb-3">
            			<h6>Follow Up Session</h6>
            			<div>
            				<p>{{ !is_null($report->followupSession) ? $report->followupSession->name : '' }}</p>
            			</div>
            		</li>

            		<li class="mb-3">
            			<h6>Treatment Goal</h6>
            			<div>
            				<p>{{ $report->treatment_goal }}</p>
            			</div>
            		</li>
            	</ol>
            </div>
            <div class="modal-footer">
            	{{-- <button type="submit" class="btn btn-primary waves-effect">Submit</button> --}}
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
           
		</div>
	</div>
</div>
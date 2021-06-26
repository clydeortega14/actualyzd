<div class="modal fade" id="add-report" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
                  <h5 class="modal-title" id="add-report-modal-label">Add New Report</h5>
                  <hr>
            </div>

            <div class="modal-body">
                  <form action="{{ route('progress.report.store') }}" method="POST">
                        @csrf

                        @include('alerts.message')

                        <input type="hidden" name="booking_id" value="{{ $booking->id}}">

                        <div class="form-group">
                              <label>Main Concern</label>
                              <textarea type="text" name="main_concern" class="form-control" rows="4" >{{ !is_null($report) ? $report->main_concern : '' }}</textarea>
                        </div>

                        <div class="form-group"> 
                              <label>Are there any medications that the client is taking?</label>
                              @if($user->hasRole('psychologist'))
                                    @php
                                          $user_role = 'psychologist';
                                    @endphp
                              @else
                                    @php
                                          $user_role = '';
                                    @endphp
                              @endif
                              <!-- client medication -->
                              <client-medication 
                                    has-prescription="{{ !is_null($report) ? $report->has_prescription : '' }}"
                                    user-role="{{ $user_role }}"
                                    user-id="{{ $user->id}}"
                                    assignee="{{ is_null($report) ? 0 : $report->toAssignee->id }}"
                                    medication="{{ !is_null($report) && $report->has_prescription ? $report->medication->medication : '' }}">
                                    
                              </client-medication>
                              <!-- end  client medication-->
                        </div>

                        <div class="form-group">
                              <label>What are your initial assessments of the client and what are her / his core concerns?</label>
                              <textarea type="text" name="initial_assessment" class="form-control" rows="4">{{ !is_null($report) ? $report->initial_assessment : '' }}</textarea>
                        </div>

                        <div class="form-group">
                              <label>Recommended for follow up session</label>
                              <select type="combobox" name="followup_session" class="form-control">
                                    <option> -- Select --</option>
                                    @foreach($followup_sessions as $followup)
                                          <option value="{{ $followup->id }}" {{ !is_null($report) && $report->followup_session == $followup->id ? 'selected' : '' }}>{{ $followup->name }}</option>
                                    @endforeach
                              </select>
                        </div>

                        <div class="form-group">
                              <label>What therapy or intervention does your client need?</label>
                              <textarea type="text" name="treatment_goal" class="form-control" rows="4">{{ !is_null($report) ? $report->treatment_goal : '' }}</textarea>
                        </div>
                        
                        <div class="form-group">
                              <button class="btn btn-primary btn-block" type="submit">Submit</button>
                              <a href="#" class="btn btn-secondary btn-block" data-dismiss="modal">Cancel</a>
                        </div>
                        
                  </form>
            </div>
		</div>
	</div>
</div>
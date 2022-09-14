<div class="modal fade" id="help-modal" tabindex="-1" aria-labelledby="HelpModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="HelpModal">Help</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="form-group">
          <input type="text" name="search_faq" class="form-control form-control-lg" placeholder="Search">
        </div>

        <!-- List of FAQ's -->
        <div id="faq-lists">
          <div class="table-responsive">
            <table class="table table-hover">
              <tbody>
                <tr>
                  <td width="10">
                    <i class="fa fa-list"></i>
                  </td>
                  <td>
                    Change or Reset Password
                  </td>
                </tr>

                <tr>
                  <td width="10">
                    <i class="fa fa-list"></i>
                  </td>
                  <td>
                    Book A Session
                  </td>
                </tr>
                <tr>
                  <td width="10">
                    <i class="fa fa-list"></i>
                  </td>
                  <td>
                    Update Profile
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>


        <!-- FAQ Steps / Procedures -->
        <div class="mt-3" id="faq-procedure">
          <h5 class="card-title">Book A Session</h5>
          <br />
          <ol>
            <li>
              <span>Click Book A Session button in the upper right corner of your homepage.</span>
              {{-- <a href="#">link to description</a> --}}
            </li>
            <li>
              <span>Click Book A Session button.</span>
              {{-- <a href="#">link to description</a> --}}
            </li>
            <li>
              <span>Answer the onboarding questions.</span>
            </li>
            <li>
              <span>Choose Prefered Date, Time and Available Psychologists.</span>
            </li>
            <li>
              <span>Then click submit booking button.</span>
            </li>
          </ol>
        </div>

        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </div>
</div>
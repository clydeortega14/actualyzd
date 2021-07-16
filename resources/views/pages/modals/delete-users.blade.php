<!-- Modal delete -->
<div class="modal  fade" id="delete-users-{{ $user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">WARNING </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
    
        <form method="GET" action="{{ route('client.user.delete.info', $user->id) }}" enctype="multipart/form-data"  id="delete_info}">
            @csrf
            <div class="form-group">

                <img src="{{ asset('images/warning.png') }}" alt="" style="width: 115px;margin-left: 182px;">
                <label for="recipient-name" class="col-form-label" style="color:red;margin-left: 101px;">NOTE : This Data will deleted permanently.</label>
            <br>
            <ul class="list-group list-group-flush" id="main_info" >
                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg> Name</h6>
                    <span class="text-secondary">{{ $user->name}}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg> Email </h6>
                    
                    <span class="text-secondary">{{ $user->email}}</span>
                </li>
                
            
            </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Delete Data</button>
            </div>
            
        </form>
        
    </div>
    
    </div>
</div>
</div>
<!-- Modal delete -->
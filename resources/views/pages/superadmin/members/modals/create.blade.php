<div class="modal fade" id="create-new-member" tabindex="-1" role="dialog" aria-labelledby="createNewPsychologist" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="createNewPsychologist">Create New Member</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        
            <form method="POST" action="{{ route('member.store') }}">
                @csrf
                <div class="form-group">
                    <label for="client">Client</label>
                    <select type="combobox" name="client" class="form-control" required>
                        <option> - Choose Client -</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" {{ old('client') == $client->id ? 'selected' : '' }}>{{ $client->name}}</option>
                        @endforeach
                    </select>
                </div>
                

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter Name" value="{{ old('name') }}">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter Email" value="{{ old('email') }}">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="**********">
                </div>

                <div class="form-group">
                    <label for="password">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="**********">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                
            </form>
            
        </div>
    
    </div>
</div>
</div>
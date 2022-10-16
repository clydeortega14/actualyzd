<table class="table" id="myTable" >
    <thead>
        <tr>
            
            <th>Name</th>
            <th>Email</th>
            <th>Status</th>
            <th>Actions</th>
            
        </tr>
    </thead>
    <tbody >
    
        @foreach($users as $user)
            <tr>
                
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <span class="{{ $user->is_active ? 'badge badge-primary' : 'badge badge-secondary'}}">
                        {{ $user->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td>
                    <a href="#" class="btn btn-{{ $user->is_active ? 'secondary' : 'primary' }} btn-sm"
                        data-toggle="modal" data-target="#update-status-{{ $user->id}}">
                        <i class="fa fa-eye"></i>
                    </a> |

                    @include('pages.superadmin.clients.users.modals.update-status')

                    <a href="#" class="btn btn-secondary btn-sm">
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach 
        </tbody>
        
    
</table>
{{$users->links()}}
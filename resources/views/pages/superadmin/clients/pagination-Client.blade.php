<table class="table table-hover">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>Contact</th>
            <th>No. of employees</th>
            <th>Status</th>
            <th style="text-align: center;">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($clients as $client)
            <tr>
                <td>{{ $client->name }}</td>
                <td>{{ $client->email }}</td>
                <td>{{ $client->postal_address }}</td>
                
                <td>{{ $client->contact_number }}</td>
                <td>{{ $client->number_of_employees }}</td>
                <td>
                    @php
                        $active = $client->is_active;
                    @endphp
                    <span class="label {{ $active ? 'badge badge-success' : 'badge badge-danger' }}">{{ $active ? 'Active' : 'Inactive' }}</span>
                </td>
                <td align="right">
                    @if(auth()->user()->hasRole('superadmin'))
                        <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-primary btn-sm">
                            <i class="fa fa-edit"></i>
                        </a> |
                        <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-{{ $client->is_active ? 'danger' : 'success' }} btn-sm"
                            data-toggle="modal" data-target="#update-status-{{ $client->id }}">
                            <i class="fa fa-eye"></i>
                        </a>
                        @include('pages.superadmin.clients.modals.update-status')
                    @endif
                </td>
            </tr>
            
        @endforeach
        
    </tbody>
</table>  
{!! $clients->render() !!} 
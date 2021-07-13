<table>
    <thead>
        <tr>
           
            <th style="font-weight:bold;text-align:center;">Name</th>
            <th style="font-weight:bold;text-align:center;">Position</th>
            <th style="font-weight:bold;text-align:center;">Company</th>
            <th style="font-weight:bold;text-align:center;">Email Address</th>
            <th style="font-weight:bold;text-align:center;">Country</th>
        </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
   
        <tr data-client-id="{{ $user->client_id }}" class="user">

          
            <td>{{ $user->name }}</td>
            <td></td>
            <td>{{ $company->name }}</td>
            <td>{{ $user->email }}</td>
            <td>Philippines</td>
        </tr>
    @endforeach
    </tbody>
</table>
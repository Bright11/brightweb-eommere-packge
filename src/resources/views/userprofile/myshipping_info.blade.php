@extends('brightweb::userprofile.userincludes.header')


@section('content')
    {{-- <div class="admin_container_main" style="margin-top:30px;"> --}}
           <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Street Address</th>
                <th>Land Mark</th>
                <th>City</th>
                <th>State</th>
                <th>Country</th>
                <th>Pincode</th>
                <th>Phone</th>
            </tr>
            
            
        </thead>
        <tbody>
            @if ($myshipping->count())
            <tr>
                <td>{{ $myshipping->name }}</td>
                <td>{{ $myshipping->email }}</td>
                <td>{{ $myshipping->street_adress }}</td>
                <td>{{ $myshipping->land_mark }}</td>
                <td>{{ $myshipping->city }}</td>
                <td>{{ $myshipping->state }}</td>
                <td>{{ $myshipping->country }}</td>
                <td>{{ $myshipping->pincode }}</td>
                <td>{{ $myshipping->phone }}</td>
            </tr>
            @endif
            
          
           
        </tbody>
        
    </table>
           
@endsection

 
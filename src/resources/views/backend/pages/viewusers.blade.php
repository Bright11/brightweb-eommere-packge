@extends('brightweb::backend.layouts.header')
   

@section('content')
<section class="admin_section">
    <div class="admin_container">
    
      <!-- top ba -->
     @include("brightweb::backend.layouts.topbar")
      <div class="page_admin_container">
        <div class="admin_sidebar">
          @include("brightweb::backend.layouts.sidebar")
        </div>
        <div class="admin_content">
            <table id="myTable" class="display" style="width: 100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>email</th>
                        <th>role</th>
                        <th>Disabled</th>
                       
                        <th>Update status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($user as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->role }}</td>
                        <td>{{ $item->status }}</td>
                       @if($item->status=="active")
                       <td><a href="{{ route('suspenduser',$item->id) }}">Acivte</a></td>
                       @else
                       <td><a href="{{ route('suspenduser',$item->id) }}" style="color:red;">Disabled</a></td>
                       @endif
                        
                    </tr>
                    @empty
                        
                    @endforelse
                   
                  
                   
                </tbody>
                
            </table>
        
        </div>
      </div>
    </div>
  </section>

@endsection

    
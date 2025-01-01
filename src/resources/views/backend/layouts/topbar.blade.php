<div class="admin_topbar">
    <ul class="admin_topbar_ul">
      <ul>
        <li><a href="">Dashboard</a></li>
      </ul>
      <ul>
        @if (session('message'))
        <li><a href="">
            {{ session('message') }}
          </a></li>
    @endif
    
   
      </ul>
      <ul>
        <li onclick="admin_open_sidebar()" class="admin_mobile_toggle"><i class="fa fa-bars" style="font-size:36px"></i></li>
        
      </ul>
    </ul>
  </div>
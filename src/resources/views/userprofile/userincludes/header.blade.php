<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $metaseo->site_title ?? 'Bright C Web Develloper' }}</title>
    

    <link rel="stylesheet" href="{{ asset("vendor/brightweb/admincss/admincss.css") }}">

    <link rel="stylesheet" href="{{ asset("vendor/brightweb/admincss/datatable.css") }}">
 
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.dataTables.min.css"/>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  </head>
  <body>

    <section class="admin_section">
        <div class="admin_container">
          <!-- top ba -->
          @include('brightweb::userprofile.userincludes.topbaruser')
         <!-- end topbar -->
          <div class="page_admin_container">
            <div class="admin_sidebar">
              @include('brightweb::userprofile.userincludes.usersidebar')
            </div>
            <div class="admin_content" style="margin-top: 30px;">
                @yield('content')
            </div>
          </div>
        </div>
      </section>
    
  <style>
    :root{
    /* --primary-color: #9AD0F5; */
    --primary-color:{{ config('sitesettings.admin_site_settings.site_primary_color', 'red') }};

    --link-color:{{ config('sitesettings.admin_site_settings.site_button_color', '#ffffff') }};
    --white-color: white;
    /* --link-color:black; */

    --light-gray-color: #f9f9f9;
    --black-color:black;
    --font-size11: 11px;
    --font-size12: 12px;
    --font-size16: 15px;
    --font-size18: 18px;
    --font-size20: 20px;
    --font-width300: 300;
    --font-width400: 400;
    --font-weight500: 500;
    --font-weight600: 600;
    --font-weight700: 700;
    --border-radius: 5px;
    --border1: 1px solid;
    --border: 2px solid ;
    --box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
  --box-shadow1: 0px 2px 5px rgba(0, 0, 0, 0.2);

  /* --gradient1: rgb(131,58,180); */
  --gradient1:{{ config('sitesettings.admin_site_setting.gradient1', "rgb(131,58,180)") }};
  
  --gradient2:{{ config('sitesettings.admin_site_setting.gradient2', "linear-gradient(90deg, rgba(131,58,180,1) 0%, rgba(253,29,29,1) 50%, rgba(252,176,69,1) 100%)") }};

  --counter_color:{{ config('sitesettings.admin_site_settings.counter_color', "white") }};

  /* --gradient2: linear-gradient(90deg, rgba(131,58,180,1) 0%, rgba(253,29,29,1) 50%, rgba(252,176,69,1) 100%);
} */
 /* --gradient1:rgb(131,58,180); */

  </style>

  <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
    
    <script src="{{ asset("vendor/brightweb/adminjs/admin_chart.js") }}"></script>

  
</body>
</html>
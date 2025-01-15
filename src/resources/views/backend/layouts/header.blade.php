<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    
   
    <link rel="stylesheet" href="{{ asset("vendor/brightweb/admincss/admincss.css") }}">

    <link rel="stylesheet" href="{{ asset("vendor/brightweb/admincss/datatable.css") }}">

    {{-- <link rel="stylesheet" href="{{route("brightweb.css",['filename'=>'nav.css'])}}"/> --}}
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
   
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
   @livewireStyles
   
  </head>
  <body>
 @livewireScripts

    @yield('content')

    <style>
      :root{
    /* --primary-color: #9AD0F5; */
    --primary-color:{{ config('brightwebconfig.admin_site_settings.site_primary_color', 'red') }};

    --link-color:{{ config('brightwebconfig.admin_site_settings.site_button_color', '#ffffff') }};
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
  --gradient1:{{ config('brightwebconfig.admin_site_setting.gradient1', "rgb(131,58,180)") }};
  
  --gradient2:{{ config('brightwebconfig.admin_site_setting.gradient2', "linear-gradient(90deg, rgba(131,58,180,1) 0%, rgba(253,29,29,1) 50%, rgba(252,176,69,1) 100%)") }};

  --counter_color:{{ config('brightwebconfig.admin_site_settings.counter_color', "white") }};

  /* --gradient2: linear-gradient(90deg, rgba(131,58,180,1) 0%, rgba(253,29,29,1) 50%, rgba(252,176,69,1) 100%);
} */
 /* --gradient1:rgb(131,58,180); */

    </style>

    @include('brightweb::backend.layouts.footer')
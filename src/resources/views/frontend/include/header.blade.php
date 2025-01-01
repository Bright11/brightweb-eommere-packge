<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
@yield('title')
    <!-- Meta Tags -->
  @yield('meta_tags')

    <!-- Favicon -->
    @if(!empty($metaseo->site_logo))
       
        <link rel="icon" type="image/x-icon" href="{{ asset('seo/' . $metaseo->site_logo) }}">
    @endif
  
    {{-- <link rel="stylesheet" href="css/translator.css">
    <link rel="stylesheet" href="css/translator.css"> --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

{{-- <link rel="stylesheet" href="{{route("brightwebfrontend.css",['filename'=>'owl.carousel.min.css'])}}"/> --}}
<link rel="stylesheet" href="{{ asset("vendor/brightweb/frontendcss/owl.carousel.min.css") }}"/>
<link rel="stylesheet" href="{{ asset("vendor/brightweb/frontendcss/owl.theme.default.css") }}"/>

{{-- <link rel="stylesheet" href="{{route("brightwebfrontend.css",['filename'=>'owl.theme.default.css'])}}"/>  --}}
<link rel="stylesheet" href="{{ asset("vendor/brightweb/frontendcss/translator.css") }}"/>


{{-- <link rel="stylesheet" href="{{route("brightwebfrontend.css",['filename'=>'translator.css'])}}"/> --}}
{{-- <link rel="stylesheet" href="{{route("brightwebfrontend.css",['filename'=>'nav.css'])}}"/> --}}
<link rel="stylesheet" href="{{ asset("vendor/brightweb/frontendcss/nav.css") }}"/>


{{-- <link rel="stylesheet" href="{{route("brightwebfrontend.css",['filename'=>'homepagestyle.css'])}}"/> --}}
<link rel="stylesheet" href="{{ asset("vendor/brightweb/frontendcss/homepagestyle.css") }}"/>

{{-- <link rel="stylesheet" href="{{route("brightwebfrontend.css",['filename'=>'slider.css'])}}"/> --}}
<link rel="stylesheet" href="{{ asset("vendor/brightweb/frontendcss/slider.css") }}"/>


{{-- <link rel="stylesheet" href="{{route("brightwebfrontend.css",['filename'=>'details_page.css'])}}"/> --}}
<link rel="stylesheet" href="{{ asset("vendor/brightweb/frontendcss/details_page.css") }}"/>

{{-- <link rel="stylesheet" href="{{route("brightwebfrontend.css",['filename'=>'login.css'])}}"/> --}}
<link rel="stylesheet" href="{{ asset("vendor/brightweb/frontendcss/login.css") }}"/>

{{-- <link rel="stylesheet" href="{{route("brightwebfrontend.css",['filename'=>'footer.css'])}}"/> --}}
<link rel="stylesheet" href="{{ asset("vendor/brightweb/frontendcss/footer.css") }}"/>
<link rel="stylesheet" href="{{ asset("vendor/brightweb/frontendcss/aboutus.css") }}"/>


{{-- <link rel="stylesheet" href="{{route("brightweb.css",['filename'=>'datatable.css'])}}"/> --}}
<link rel="stylesheet" href="{{ asset("vendor/brightweb/admincss/datatable.css") }}"/>

@stack('style')

{{--  <link rel="stylesheet" href="{{route("brightweb.css",['filename'=>'admincss.css'])}}"/>
 --}}
</head>
<body>

    @include('brightweb::frontend.include.navbar')
    <div class="spacer"></div>
@yield('content')

<style>
 
:root {
    --bg-color-trans:transparent;
/* --primary-color: #2D00F7; */
--site-color2:rgba(255, 100, 77, 0.6); 

--font-size16: 16px;
--light-gray-color: #f9f9f9;
--black-color:black;
--font-size11: 11px;
--font-size12: 12px;
--font-size18: 18px;
--font-size20: 20px;
--font-width300: 300;
--font-width400: 400;
--font-weight500: 500;
--font-weight600: 600;
--font-weight700: 700;

/* transition */
--bg-transition: background-color 0.3s ease-in-out;
--text-transition: color 0.3s ease-in-out;
/* box-shadow */
--box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
--box-shadow1: 0px 2px 5px rgba(0, 0, 0, 0.2);
/* border */
--border-radius: 5px;
--border1: 1px solid;
--border: 2px solid ;
--border-color: #232f3e;
--transition: border-color 0.5s ease-in-out;
/* padding */
--padding: 10px;
--padding-small: 5px;
/* margin */
--margin-top: 10px;
--margin-bottom: 10px;
/* font */
--font-family: "Poppins", sans-serif;
--font-style: normal;
/* hover */
--hover-bg-color: #f1f1f1;
  --bg-color:{{ config('brightwebconfig.frontend_site_settings.site_bg_color', '#ffffff') }};
  --primary-color:{{ config('brightwebconfig.frontend_site_settings.site_primary_color', '#2D00F7') }};
  
  --btn-color:{{ config('brightwebconfig.frontend_site_settings.site_button_color', 'white') }};
  --text-color:{{ config('brightwebconfig.frontend_site_settings.site_text_color', 'gray') }};;

  --navprimary-color:{{ config('brightwebconfig.frontend_navigation_settings.navigation_bg_color', ' #000000') }};;
  /* --navprimary-color: #000000; */
/* --nav-link-color:white; */
--nav-link-color:{{ config('brightwebconfig.frontend_navigation_settings.navigation_text_color', ' white') }};;

 
}

</style>
    @include('brightweb::frontend.include.footer')
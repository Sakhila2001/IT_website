<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>@yield('title')</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('assets/dashboard/css/app.min.css') }}">
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('assets/dashboard/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/dashboard/css/components.css') }}">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="{{ asset('assets/dashboard/css/custom.css') }}">
  <link rel="shortcut icon" href="{{ $contact->fav_image ? asset('storage/' . $contact->fav_image) : asset('assets/default-favicon.ico') }}" type="image/x-icon">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

<style>.dropdown-menu {
    display: none;
}

.dropdown.active .dropdown-menu {
    display: block;
}</style>

        @yield('style')

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    
    <body class="font-sans antialiased">
    @include('layouts.navigation')
  @include('layouts.sidebar')

  @yield('content')

  @include('layouts.footer')
      
    </body>
    <!-- General JS Scripts -->
  <script src="{{ asset('assets/dashboard/js/app.min.js') }}"></script>
  <!-- JS Libraies -->
  <script src="{{ asset('assets/dashboard/bundles/apexcharts/apexcharts.min.js') }}"></script>
  <!-- Page Specific JS File -->
  <script src="{{ asset('assets/dashboard/js/page/index.js') }}"></script>
  <!-- Template JS File -->
  <script src="{{ asset('assets/dashboard/js/scripts.js') }}"></script>
  <!-- Custom JS File -->
  <script src="{{ asset('assets/dashboard/js/custom.js') }}"></script>
  <script>
    document.querySelectorAll('.menu-toggle').forEach(item => {
        item.addEventListener('click', function (e) {
            // Prevent the default link behavior
            e.preventDefault();

            // Toggle the 'active' class to show/hide the dropdown
            let dropdown = this.closest('.dropdown');
            dropdown.classList.toggle('active');
        });
    });
</script>


  @yield('scripts')
</html>

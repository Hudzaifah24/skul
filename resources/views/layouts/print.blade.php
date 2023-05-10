<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Title --}}
    <title>@yield('title')</title>

    {{-- Style --}}
    @include('includes.style')

    @stack('style')

  </head>

  <body class="nav-md">
    <div class="container body" style="height: 100%">
      <div class="main_container">

        <!-- page content -->
        <div class="" role="main">
          <!-- top tiles -->

          {{-- Content --}}
          @yield('content')

        </div>
      </div>
    </div>

    {{-- Script --}}
    @include('includes.script')

    @stack('scripts')
  </body>
</html>

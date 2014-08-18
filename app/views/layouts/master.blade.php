<!DOCTYPE html>

<html>
  <head>
    <title>Scholarship Application</title>
    <link rel="icon" type="image/ico" href="/favicon.ico?v1"/>
    <link rel="stylesheet" href="/dist/css/main.css"/>
    <script src="/dist/js/modernizr.js"></script>
  </head>

  <body>
    <div id="page" class="page">

      <div class="container">
        @include('layouts.partials.header')


        @if (Session::has('flash_message'))
          <div class="flash">
            <em>{{ Session::get('flash_message') }}</em>
          </div>
        @endif

        <main role="main">
          @yield('main_content')
        </main>

        @include('layouts.partials.footer')
      </div>

      @include('layouts.partials.navigation')

    </div>

    <script src="/dist/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="/dist/js/main.js"></script>
  </body>
</html>

<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
          <div class="flash-message">
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

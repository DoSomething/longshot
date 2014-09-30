<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Scholarship Application</title>
    <link rel="icon" type="image/ico" href="/favicon.ico?v1"/>
    <script src="/dist/js/modernizr.js"></script>
    <link rel="stylesheet" href="/dist/css/main.css"/>

    @if (file_exists(app_path() . '/views/layouts/partials/custom-styles.blade.php'))
      <style>
        @include('layouts.partials.custom-styles')
      </style>
    @endif

    @if (! empty($vars->tracking_code_id))
      @include('layouts.partials.google-analytics')
    @endif
  </head>

  <body class="{{ bodyClass() }}">
    <div id="container" class="container">

      <div class="panel panel--main">
        @include('layouts.partials.header')

        @if (Session::has('flash_message'))
          <div class="flash-message">
            <em>{{ Session::get('flash_message') }}</em>
          </div>
        @endif

        <div id="content" class="content">
          <main role="main">
            @yield('main_content')
          </main>

          @yield('complementary_content')
        </div>

        @include('layouts.partials.footer')
      </div>

      @include('layouts.partials.navigation')

    </div>

    @include('layouts.partials.upgrade-message')

    <script src="/dist/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="/dist/js/main.js"></script>

  </body>
</html>

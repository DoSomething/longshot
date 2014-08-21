<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Scholarship Application Administration</title>
    <link rel="icon" type="image/ico" href="/favicon.ico?v1"/>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    @section('styles')
      <link rel="stylesheet" href="/dist/css/admin.css"/>
    @show
  </head>

  <body>
    @include('layouts.partials.admin-navigation')

    @yield('jumbotron')


    @if (Session::has('flash_message'))
      <div class="flash">
        <em>{{ Session::get('flash_message') }}</em>
      </div>
    @endif

    @yield('main_content')

    <script src="/dist/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  </body>
</html>

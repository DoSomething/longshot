<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Scholarship Application Administration</title>
    <link rel="icon" type="image/ico" href="/favicon.ico?v1"/>
    <link rel="stylesheet" href="/css/bootstrap.css">
    <script src="/dist/js/jquery.min.js"></script>
    @section('styles')
      <link rel="stylesheet" href="/css/admin.css"/>
    @show
  </head>

  <body class="{{ bodyClass() }}">
    @include('admin.layouts.partials.navigation')

    @if (Session::has('flash_message'))
      <div class="alert {{ Session::get('flash_message')['class'] }} alert-dismissible fade in" role="alert">
        <em>{{ Session::get('flash_message')['text'] }}</em>
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span>
      </div>
    @endif

    @yield('jumbotron')

    @yield('main_content')

    <script src="/dist/js/bootstrap.min.js"></script>
    <script src="/dist/js/main.js"></script>

  </body>
</html>

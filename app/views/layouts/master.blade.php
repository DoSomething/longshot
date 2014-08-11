<!DOCTYPE html>

<html>
  <head>
    <title>Scholarship Application</title>
  </head>

  <body>
    @include('partials.header')


    @if (Session::get('flash_message'))
      <div class="flash">
        <em>{{ Session::get('flash_message') }}</em>
      </div>
    @endif

    <main role="main">
      @yield('main_content')
    </main>

    @include('partials.navigation')

    @include('partials.footer')
  </body>
</html>

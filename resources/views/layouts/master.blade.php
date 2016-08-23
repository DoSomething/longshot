<!DOCTYPE html>

<!--[if lte IE 8]><html class="no-js lt-ie9 lte-ie8" lang="en"><![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if (isset($global_vars->custom_font_kit_id) && isset($global_vars->custom_font_name))
      <script src="https://use.typekit.net/{{ $global_vars->custom_font_kit_id }}.js"></script>
      <script>try{Typekit.load({ async: true });}catch(e){}</script>
      <style type="text/css"> body { font-family: "{!! $global_vars->custom_font_name !!}" !IMPORTANT; } .heading { font-family: "{!! $global_vars->custom_font_name !!}" !IMPORTANT; font-weight:700 !IMPORTANT;}</style>
    @endif


    <title>{{ isset($page) ? $page->title . ' | ' : '' }}{{ $global_vars->site_name or 'Scholarship Application' }}</title>

    <link rel="icon" type="image/ico" href="{{ $global_vars->favicon or '/favicon.ico' }}"/>
    <script src="/dist/js/modernizr.js"></script>
    <link rel="stylesheet" href="/css/main.css"/>

    @if (Cache::has('custom.styles'))
      {!! '<style>' . Cache::get('custom.styles') . '</style>' !!}
    @endif

    @include('layouts.partials.open-graph-data')

    @if (isset($global_vars->tracking_code_id))
      @include('layouts.partials.google-analytics')
    @endif
  </head>

    @if (!empty($global_vars->background_image))
      <body class="{{ bodyClass() }}" background="{{ $global_vars->background_image }}">
    @else
      <body class="{{ bodyClass() }}">
    @endif
    <div id="container" class="container">

      <div class="panel panel--main">
        @include('layouts.partials.header')

        @if (Session::has('flash_message'))
          <div class="flash-message {{ Session::get('flash_message')['class'] }}">
            <em>{{ Session::get('flash_message')['text'] }}</em>
          </div>
        @endif

        @if (count($errors) > 0)
          <div class="flash-message -error">
            <em>There are errors in form below, please fix them.</em>
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

    <script src="/dist/js/jquery.min.js"></script>
    <script src="/dist/js/main.js"></script>

  </body>
</html>

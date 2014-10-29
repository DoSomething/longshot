<?php //dd($vars); ?>

<!DOCTYPE html>

<!--[if lte IE 8]><html class="no-js lt-ie9 lte-ie8" lang="en"><![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <meta property="og:title" content="Know a scholar athlete who deserves $20k?">
    <meta property="og:description" content="We're giving away $20,000 to 20 student athletes who demonstrate excellence in school, on their sports teams, and in their communities. Apply or nominate someone today!">
    <meta property="og:type" content="website">
    <meta property="og:title" content="">
    <meta property="og:image" content="{{ $vars->header_logo }}">

    <title>
      {{ isset($page) ? $page->title . ' | ' : '' }}{{ $vars->company_name }} Scholarship Application
    </title>


    <link rel="icon" type="image/ico" href="{{ $vars->favicon or '/favicon.ico' }}"/>
    <script src="/dist/js/modernizr.js"></script>
    <link rel="stylesheet" href="/dist/css/main.css"/>

    @if (Cache::has('custom.styles'))
      {{ '<style>' . Cache::get('custom.styles') . '</style>' }}
    @endif

    @if (!empty($vars->tracking_code_id))
      @include('layouts.partials.google-analytics')
    @endif
  </head>

  <body class="{{ bodyClass() }}">
    <div id="container" class="container">

      <div class="panel panel--main">
        @include('layouts.partials.header')

        @if (Session::has('flash_message'))
          <div class="flash-message {{ Session::get('flash_message')['class'] }}">
            <em>{{ Session::get('flash_message')['text'] }}</em>
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

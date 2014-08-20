<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Scholarship Application Administration</title>
    <link rel="icon" type="image/ico" href="/favicon.ico?v1"/>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="/dist/css/admin.css"/>
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Scholarship App</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#pages">Pages</a></li>
            <li><a href="#applications">Applications</a></li>
            <li><a href="#reports">Reports</a></li>
            <li><a href="/logout">Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    @yield('jumbotron')

    <div class="container">
      @if (Session::has('flash_message'))
        <div class="flash">
          <em>{{ Session::get('flash_message') }}</em>
        </div>
      @endif

      <main role="main">
        @yield('main_content')
      </main>

      <hr>

      <footer role="contentinfo">
        <p>&copy; a <a href="http://www.tmiagency.org/">TMI</a> joint, in collaboration with CompanyNameHere.</p>
      </footer>
    </div>

    <script src="/dist/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  </body>
</html>

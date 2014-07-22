<!DOCTYPE html>

<html>
	<head>
		<title>Scholarship Application</title>
	</head>

	<body>
		<header role="banner">
      <h1>Scholarship App</h1>
      <a href="#main-nav">Main Navigation</a>
    </header>
    
    <main role="main">
      @yield('main_content')
    </main>

		@include('partials.navigation')
	</body>
</html>
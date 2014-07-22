<!DOCTYPE html>

<html>
	<head>
		<title>Scholarship Application</title>
	</head>

	<body>
		@include('partials.header')
    
    <main role="main">
      @yield('main_content')
    </main>

		@include('partials.navigation')

    @include('partials.footer')
	</body>
</html>
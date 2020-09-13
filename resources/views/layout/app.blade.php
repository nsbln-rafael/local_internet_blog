<!doctype html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<title>Hello, world!</title>
</head>
<body>
	<div style="margin-top: 100px">
		<header>
			<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
				<a href="{{ url('/') }}" class="navbar" style="color: white">Blog</a>
				<div class="collapse navbar-collapse" id="navbarCollapse">
					<ul class="navbar-nav mr-auto">
					</ul>
					<div class="form-inline mt-2 mt-md-0">
						<?php if (Auth::user()): ?>
							<a class="navbar" style="color: bisque" >Hello, {{ Auth::user()->email  }}</a>
							<a href="{{ url('logout') }}" class="navbar" style="color: white">Logout</a>
						<?php else: ?>
							<a href="{{ url('login') }}" class="navbar" style="color: white" >Login</a>
							<a href="{{ url('registration') }}" class="navbar" style="color: white">Register</a>
						<?php endif ?>
					</div>
				</div>
			</nav>
		</header>
	</div>

	<div class="container">
		<?php if (session('status')): ?>
			<div id="notification" class="alert alert-primary" role="alert">
				{{ session('status') }}
			</div>
		<?php elseif (session('error')): ?>
			<div id="notification" class="alert alert-warning" role="alert">
				{{ session('error') }}
			</div>
		<?php endif; ?>

		@yield('content')
	</div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script>
	$(document).ready(function() {
		$('#notification').fadeOut(2000);
	});
</script>
</html>
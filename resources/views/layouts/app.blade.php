<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css2?family=Gruppo&display=swap" rel="stylesheet">
	<!-- Style -->
	<style>
		#appTitle {
			font-family: 'Gruppo', cursive;
		}

		.activity-header {
			margin-bottom: -10px;
		}

		.activity-name {
			font-size: 14px;
		}

		.action-button {
			float: right;
			color: #ffc107;
		}
	</style>
	<!-- Title -->
	<title>Daily Activity Tracker</title>
</head>

<body>
	@section('navbar')
	<!-- Top Navbar Brand -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
		<a class="navbar-brand font-weight-bold" id="appTitle" href="/">Daily Activity Tracker</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarShortcut" aria-controls="navbarShortcut" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarShortcut">
			<ul class="navbar-nav ml-auto mr-4">
				<li class="nav-item pr-2">
					<a class="nav-link text-white" href="#" data-toggle="modal" data-target="#modalAddProgress"><i class="fas fa-running"></i> What will you do today?</a>
				</li>	
				<li class="nav-item pr-2">
					<a class="nav-link" href="/"><i class="fas fa-home"></i> Home</a>
				</li>
				<li class="nav-item pr-2">
					<a class="nav-link" href="#" data-toggle="modal" data-target="#modalHelp"><i class="fas fa-question-circle"></i> Help</a>
				</li>
			</ul>
		</div>
	</nav>
	@show

	<div id="content">
		@yield('content')
	</div>

	<!-- Optional JavaScript -->
	<script src="https://kit.fontawesome.com/60a6db6bb7.js" crossorigin="anonymous"></script>
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>
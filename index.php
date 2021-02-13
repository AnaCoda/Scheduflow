<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/style.css">
	<script src="https://kit.fontawesome.com/38b15697bc.js" crossorigin="anonymous"></script>
	<title>Document</title>
</head>
<body>
	<nav class="navbar">
		<ul class="navicons topicons">
			<li><i class="fas fa-home wideboi"></i></li>
			<li><i class="fas fa-chart-bar wideboi"></i></li>
			<li><i class="fas fa-sticky-note"></i></li>
		</ul>
		<ul class="navicons boticons">
			<li><i class="fas fa-cog settings-icon"></i></li>
			<li>
				<div class="user-icon">
					<?php echo file_get_contents("img/profile-pic.svg");?>
				</div>
			</li>
		</ul>
	</nav>
	<main class="content">
		<h1>Scheduflow</h1>
		<p>The thing that helps students, from students</p>
		<button>Sign Up</button>
		<button>Log In</button>
	</main>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/index.css">
	<script src="https://kit.fontawesome.com/38b15697bc.js" crossorigin="anonymous"></script>
	<title>Document</title>
</head>
<body>
	<nav class="navbar">
		<ul class="navicons topicons">
			<a href="/index.php"><li><i class="fas fa-home wideboi"></i></li></a>
			<a href="/schedule.php"><li><i class="fas fa-chart-bar wideboi"></i></li></a>
			<a href="/eventadd.php"><li><i class="fas fa-sticky-note"></i></li></a>
		</ul>
		<ul class="navicons boticons">
			<!-- <li><i class="fas fa-cog settings-icon"></i></li> -->
			<li>
				<a href="/profile.php">
					<div class="user-icon">
						<?php echo file_get_contents("img/profile-pic.svg");?>
					</div>
				</a>
			</li>
		</ul>
	</nav>
	<main class="content">
		<?php echo file_get_contents("img/Logo.svg");?>
		<p>Helping students (and teachers) keep track of their lives.</p>
		<div class="buttons">
			<a href="/login.php" class="form-input submit-button">Login</a>
			<a href="/signup.php" class="form-input submit-button">Signup</a>
		</div>
		<img src="img/pexels-photo-4050315.jpg" alt="Student Studying Picture">
	</main>
</body>
</html>
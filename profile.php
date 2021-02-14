<!DOCTYPE html>
<html>
<head>
	<title>
		Topic Creation
	</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/profile.css">
	<script src="https://kit.fontawesome.com/38b15697bc.js" crossorigin="anonymous"></script>
</head>
<body>
	<nav class="navbar">
		<ul class="navicons topicons">
			<a href="/index.php"><li><i class="fas fa-home wideboi"></i></li></a>
			<a href=""><li><i class="fas fa-chart-bar wideboi"></i></li></a>
			<a href=""><li><i class="fas fa-sticky-note"></i></li></a>
		</ul>
		<ul class="navicons boticons">
			<li><i class="fas fa-cog settings-icon"></i></li>
			<li>
				<a href="/profile.php">
					<div class="user-icon">
						<?php echo file_get_contents("img/profile-pic.svg");?>
					</div>
				</a>
			</li>
		</ul>
	</nav>
	<main class="container">
		<h1>Dashboard</h1>
		<!-- TOPICS LIST -->
		<div class="subjects">
			<!-- form to add another topic -->
			<?php
			session_start();
			// Check that they're logged in, otherwise redirect
			if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
			{
				require "dbconnection.php";
				$id = $_SESSION['id'];
				$topicquery = $curLink->query("SELECT * FROM `topics` WHERE user_id='$id'") or die(printf(mysqli_error($curLink)));

				$topics = $topicquery->fetch_all(MYSQLI_ASSOC);
				
				if (isset($_POST['topicname']))
				{
						$topicname = $curLink->real_escape_string($_POST['topicname']);
						$curLink->query("INSERT INTO topics (user_id, topicname) VALUES(
								'".$_SESSION['id']."',
								'$topicname')") or die(mysqli_error($curLink));
						header('Refresh: 0');
				}
			}
			else
			{
					header("Location: login.php"); // Redirect to the login page
			}
			?>
			<h2>Your Subjects</h2>
			<hr>
			<?php
				foreach ($topics as $t) { ?>
				<div class="topic-name"><?= $t['topicname'] ?></div>
			<?php } ?>
		</div>
		<div class="add-subject">

			<h2>Add a Topic</h2>
			<div id="topics">
				<form action="" method="post" class="form-horizontal" autocomplete="off">
				<p>Topic Name:</p>
				<input class="form-submit" type="text"name="topicname">
				<input class="form-submit submit-button" type="submit" value="Submit">
				</form>
			</div>
		</div>
	<div class="other-stuff"></div>
	</main>
</body>
</html>
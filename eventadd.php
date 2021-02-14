<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/login.css">
	<script src="https://kit.fontawesome.com/38b15697bc.js" crossorigin="anonymous"></script>
	<title>Add Event</title>
</head>
<body>
	<nav class="navbar">
		<ul class="navicons topicons">
			<a href="/index.php"><li><i class="fas fa-home wideboi"></i></li></a>
			<a href=""><li><i class="fas fa-chart-bar wideboi"></i></li></a>
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
	<main class="container cont-for-eventadd">
		<?php require "dbconnection.php";
		session_start();	// Check that they're logged in, otherwise redirect
		if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
		{
			if(isset($_POST['timeconstraint']) && (isset($_POST['first_submit'])))
			{
				$timeconstraint = $_POST['timeconstraint'];
			}
			if(isset($timeconstraint) && (isset($_POST['first_submit'])))
			{
				if($timeconstraint == 'oneday' || $timeconstraint == 'until')
				{
					?>
					<h1>Select A Date</h1> <!--Jim-senpai pls add css and classes thx-->
					<form action="" method="POST" autocomplete="off">
					<input class="form-input date-picker" type="date" name="selecteddate">
					<?php
				}
				else
				{
					?>
					<form action="" method="POST" autocomplete="off"> 
					<?php
					$selecteddate = null;
				}
				if (isset($_POST['eventname']) && (isset($_POST['selectedtopic'])))
				{
					$eventname = $_POST['eventname'];
				}
				if (isset($_POST['selecteddate']))
				{
					$selecteddate = $_POST['selecteddate'];
				}
				?>
				<h1>Name your Task:</h1>
				<input class="form-input" type="text" name="eventname"><br>
				<h1>Choose a Topic</h1>
				<?php
				$temp = $curLink->query("SELECT * FROM `topics`");
				$topics = $temp->fetch_all(MYSQLI_ASSOC);
				foreach ($topics as $t) 
				{
					?>
					<input class="form-input topic-choosing" type="submit" name="selectedtopic" value="<?= $t['topicname']?>">
					<?php
				}
				?>
				<h1>Completion Time:</h1>
				<label for="minutes">Minutes</label>
				<select class="form-input" name="minutes" id="timeminutes">
					<option value="0">0</option>
					<option value="5">5</option>
					<option value="10">10</option>
					<option value="15">15</option>
					<option value="20">20</option>
					<option value="25">25</option>
					<option value="30">30</option>
					<option value="35">35</option>
					<option value="40">40</option>
					<option value="45">45</option>
					<option value="50">50</option>
					<option value="55">55</option>
				</select>
				<label for="hours">Hours</label>
				<select class="form-input" name="hours" id="timehours">
					<option value="0">0</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
				</select>
				<?php
			}
			else
			{
				?>
				<h1>Choose a Time:</h1>
				<form action="eventadd.php" method="POST" autocomplete="off">
					<p><input class="time-button" type="radio" name="timeconstraint" value="oneday">For One Day</p>
					<p><input class="time-button" type="radio" name="timeconstraint" value="indefinite">Until Turned Off</p>
					<p><input class="time-button" type="radio" name="timeconstraint" value="until">Everyday Until</p>
					<input class="choose-time-button form-input" type="submit" name="first_submit" value="Submit">
				</form>
				<?php
			}
			if(isset($_POST['selectedtopic']) /*this breaks the code dont know why :( && isset($eventname) && $eventname != ''*/)
			{
				$totaltimeminutes = intval($_POST['minutes']) + 60*intval($_POST['hours']) or die(mysqli_error($curLink));
				$eventname = $curLink->real_escape_string($_POST['eventname']);
				$selectedtopic = $curLink->real_escape_string($_POST['selectedtopic']);
				$curLink->query("INSERT INTO events (user_id, eventtopic, eventname, eventtime, eventduration, eventtype) VALUES(
						'".$_SESSION['id']."',
						'$selectedtopic',
						'$eventname',
						null,
						'$totaltimeminutes',
						0)") or die(mysqli_error($curLink));
				header('Refresh: 0');
			}
			?>
			</form>
			<?php	
		}
		else
		{
			header("Location: login.php"); // Redirect to the login page
		}
		?>
	</main>		
</body>

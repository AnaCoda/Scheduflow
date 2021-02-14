<!DOCTYPE html>
<!-- Code By Webdevtrick ( https://webdevtrick.com )-->
<html lang="en">

<head>

	<meta charset="UTF-8">
	<title>Your Schedule</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/chart.css">
	<script src="https://kit.fontawesome.com/38b15697bc.js" crossorigin="anonymous"></script>

</head>
<?php
session_start();
// Check that they're logged in, otherwise redirect
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
	require "dbconnection.php";
	$id = $_SESSION['id'];
	$eventquery = $curLink->query("SELECT * FROM `events` WHERE user_id='$id'") or die(printf(mysqli_error($curLink)));
	$events = $eventquery->fetch_all(MYSQLI_ASSOC);
	$topicquery = $curLink->query("SELECT * FROM `topics` WHERE user_id='$id'") or die(printf(mysqli_error($curLink)));
	$topics = $topicquery->fetch_all(MYSQLI_ASSOC);
} else {
	header("Location: login.php"); // Redirect to the login page
}
?>

<body>
  <nav class="navbar">
		<ul class="navicons topicons">
			<a href="/index.php">
				<li><i class="fas fa-home wideboi"></i></li>
			</a>
			<a href="/schedule.php">
				<li><i class="fas fa-chart-bar wideboi"></i></li>
			</a>
			<a href="/eventadd.php">
				<li><i class="fas fa-sticky-note"></i></li>
			</a>
		</ul>
		<ul class="navicons boticons">
			<!-- <li><i class="fas fa-cog settings-icon"></i></li> -->
			<li>
				<a href="/profile.php">
					<div class="user-icon">
						<?php echo file_get_contents("img/profile-pic.svg"); ?>
					</div>
				</a>
			</li>
		</ul>
	</nav>

  <h1>Your Schedule</h1>
  <div class="chart">
        <span class="label"><?= 'Timeline' ?></span>
        <div class="bar stackeder" data-percent="0"></div>
        <?php
        foreach ($topics as $t) {
          #echo $t['topicname'];
          $eventquery = $curLink->query("SELECT 
          (`eventduration`) FROM `events` WHERE user_id='$id' AND eventtopic='".$t['topicname']."'") or die(printf(mysqli_error($curLink)));
          $events = $eventquery->fetch_row();
          $durationsum = $events[0];
          ?>
        <div class="bar stackeder" data-percent='<?= $durationsum?>'><span class="labelstack"><?= $t['topicname'] ?></span></div>
        <?php }?>
      </div>
  <div class="wrap">
    <!--<div class="bar" data-percent="20"> <span class="label"></span></div>-->
    <?php
    foreach ($topics as $t) {
      $eventquery = $curLink->query("SELECT * FROM `events` WHERE user_id='$id' AND eventtopic='".$t['topicname']."'") or die(printf(mysqli_error($curLink)));
      $events = $eventquery->fetch_all(MYSQLI_ASSOC);
      ?>
      
      <div class="chart">
        <span class="label"><?= $t['topicname'] ?></span>
        <div class="bar stackeder" data-percent="0"></div>
        <?php
        
        foreach ($events as $e) {?>
        
        <div class="bar stackeder" data-percent="<?= $e['eventduration'] ?>"><span class="labelstack"><?= $e['eventname'] ?></span></div>
      
        <?php }?></div><?php } ?>
      
    </div>
</div>
	</main>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	<script src="js/chart.js"></script>
</body>
</html>
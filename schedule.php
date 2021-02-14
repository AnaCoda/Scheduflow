<!DOCTYPE html>
<!-- Code By Webdevtrick ( https://webdevtrick.com )-->
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Your Schedule</title>
  <link href="https://fonts.googleapis.com/css?family=Electrolize&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/chart.css">
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
  <h1>Your Schedule</h1>
  <div class="wrap">
    <!--<div class="bar" data-percent="20"> <span class="label"></span></div>-->
    <?php
    foreach ($topics as $t) { ?>
      
      <div class="chart">
        <span class="label"><?= $t['topicname'] ?></span>
        <div class="bar" data-percent="40"></div>
        <div class="bar" data-percent="10"><span class="labelstack"></span></div>
      </div>
    <?php } ?>
    <div class="chart">
      <span class="label">jQuery</span>
      <div class="bar" data-percent="40"></div>
      <div class="bar" id='moving-bar' data-percent="10"><span class="labelstack"></span></div>
    </div>
    </div>
</div>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/chart.js"></script>

</body>

</html>


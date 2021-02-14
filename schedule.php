<!DOCTYPE html>
<!-- Code By Webdevtrick ( https://webdevtrick.com )-->
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Your Schedule</title>
  <link href="https://fonts.googleapis.com/css?family=Electrolize&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/chart.css">
</head>
<?php
  session_start();
  // Check that they're logged in, otherwise redirect
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
  {
    require "dbconnection.php";
    $id = $_SESSION['id'];
    $eventquery = $curLink->query("SELECT * FROM `events` WHERE user_id='$id'") or die(printf(mysqli_error($curLink)));
    $events = $eventquery->fetch_all(MYSQLI_ASSOC);
    $topicquery = $curLink->query("SELECT * FROM `topics` WHERE user_id='$id'") or die(printf(mysqli_error($curLink)));
    $topics = $topicquery->fetch_all(MYSQLI_ASSOC);
  }
  else
    {
        header("Location: login.php"); // Redirect to the login page
    }
?>
<body>
   <div class="wrap">
<h1>Your Schedule</h1>
<?php 
          foreach ($topics as $t) { ?>
          <!--<div class="bar" data-percent="20"> <span class="label"></span></div>-->
          <div class="row">
          <div id="container chart">
        <div class="bar stacked" data-percent="40"><span class="label second"><?= $t['topicname'] ?></span></div><div class="bar stacked stackeder" data-percent="10"><span class="labelstack"></span></div>
                  </div>
          </div>
          </div>
<?php } ?>
<div id="container chart">
<div class="bar stacked" data-percent="40"><span class="label second">jQuery</span></div><div class="bar stacked stackeder" id='moving-bar' data-percent="10"><span class="labelstack"></span></div>
          </div>
  </div>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script  src="js/chart.js"></script>

</body>
</html>

<head>
</head>
<body>
    <div>
    <?php require "dbconnection.php";
        session_start();
        // Check that they're logged in, otherwise redirect
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
        {
          if(isset($_POST['timeconstraint']) && (isset($_POST['first_submit']))) {
            $timeconstraint = $_POST['timeconstraint'];
          }
          if(isset($timeconstraint) && (isset($_POST['first_submit']))){
            printf($timeconstraint);
            if($timeconstraint == 'oneday' || $timeconstraint == 'until'){
              ?><h1>Select A Date</h1> <!--Jim-senpai pls add css and classes thx-->
              <form action="" method="POST" autocomplete="off">
                  <input type="date" name="selecteddate">
                 <?php
            } else {
              ?>
              <form action="" method="POST" autocomplete="off"> <?php
              $selecteddate = null;
            }
            printf("after else");
            if(isset($_POST['eventname']) && (isset($_POST['selectedtopic']))){
              $eventname = $_POST['eventname'];
              printf("we have an eventname");
            }
            printf($eventname && (isset($_POST['selectedtopic'])));
            if(isset($_POST['selecteddate'])){
              $selecteddate = $_POST['selecteddate'];
            }
          }
          else{
            ?><h1>Step One: Choose a Time:</h1><br>
            <form action="eventadd.php" method="POST" autocomplete="off">
              <input type="radio" name="timeconstraint" value="oneday">
              For One Day<br>
              <input type="radio" name="timeconstraint" value="indefinite">
              Until Turned Off<br>
              <input type="radio" name="timeconstraint" value="until">
              Everyday Until<br>
              <input type="submit" name="first_submit" value="Submit">
            </form>
          <?php }
            printf($selecteddate);
            if(isset($_POST['selectedtopic']) /*&& isset($eventname) && $eventname != '' && isset($selecteddate) && $selecteddate != ''*/){
              ?><h1>Event name <?php echo $eventname?></h1>
              <?php
              $eventname = $curLink->real_escape_string($_POST['eventname']);
              $selectedtopic = $curLink->real_escape_string($_POST['selectedtopic']);
              ?><h1>Parameters: eventname: <?php echo $eventname?> selectedtopic: <?php echo $selectedtopic?></h1>
              <?php
              $curLink->query("INSERT INTO events (user_id, eventtopic, eventname, eventtime, eventtype) VALUES(
                  '".$_SESSION['id']."',
                  '$selectedtopic',
                  '$eventname',
                  null,
                  0)") or die(mysqli_error($curLink));
              header('Refresh: 0');
            }
              ?>
                <h1>Step Two: Name your Task:</h1>
                <input type="text" name="eventname"><br>
                <h1>Step Three: Choose a Topic</h1>
                <?php 
              $temp = $curLink->query("SELECT * FROM `topics`");
              $topics = $temp->fetch_all(MYSQLI_ASSOC);
                foreach ($topics as $t) { ?>
                  <input type="submit" name="selectedtopic" value="<?= $t['topicname']?>">
                <?php }
            ?></form><?php
            
          }
        else
        {
          header("Location: login.php"); // Redirect to the login page
        }
        ?>
        <h1>Current topic:<?=$selectedtopic?></h1>
    </div>
    
</body>

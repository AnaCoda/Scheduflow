<head>
</head>
<body>
    <div>
    <?php require "dbconnection.php";
        session_start();
        // Check that they're logged in, otherwise redirect
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
        {
          if(isset($_POST['timeconstraint'])) {
            $timeconstraint = $_POST['timeconstraint'];
            
            if($timeconstraint == 'oneday' || $timeconstraint == 'until'){
              ?><h1>Select A Date</h1> <!--Jim-senpai pls add css and classes thx-->
              <form action="eventadd.php" method="post" autocomplete="off">
                  <input type="date" name="selecteddate">
                 </form><?php
            } else {
              $selecteddate = null;
            }
            if(isset($_POST['eventname'])){
              $eventname = $_POST['eventname'];
            }
            if(isset($_POST['selecteddate'])){
              $selecteddate = $_POST['selecteddate'];
            }
            
            if(isset($_POST['selectedtopic']) && isset($eventname) && $eventname != '' && isset($selecteddate) && $selecteddate != ''){
              ?><h1>Event name <?php echo $eventname?></h1>
              <?php
              $eventname = $curLink->real_escape_string($_POST['eventname']);
              $selectedtopic = $curLink->real_escape_string($_POST['selectedtopic']);
              $selecteddate = $_POST['']
              ?><h1>Parameters: eventname: <?php echo $eventname?> selectedtopic: <?php echo $selectedtopic?></h1>
              <?php
              $curLink->query("INSERT INTO events (user_id, eventtopic, eventname, eventtime, eventtype) VALUES(
                  '".$_SESSION['id']."',
                  '$selectedtopic',
                  '$eventname',
                  '$selecteddate',
                  0)") or die(mysqli_error($curLink));
              header('Refresh: 0');
            }
              ?>
              <form action="eventadd.php" method="post" autocomplete="off">
                <h1>Step Two: Name your Task:</h1></div>
                <input type="text" name="eventname">
                </div><br>
                <h1>Step Three: Choose a Topic</h1>
                <?php 
              $temp = $curLink->query("SELECT * FROM `topics`");
              $topics = $temp->fetch_all(MYSQLI_ASSOC);
                foreach ($topics as $t) { ?>
              <div>
                
                  <input type="submit" name="selectedtopic" value="<?= $t['topicname']?>">
                </div>
                <?php }
            ?></form><?php
            
          }else{
            ?><h1>Step One: Choose a Time:</h1><br>
            <form action="eventadd.php" method="post" autocomplete="off">
              <input type="radio" name="timeconstraint" value="oneday">
              For One Day<br>
              <input type="radio" name="timeconstraint" value="indefinite">
              Until Turned Off<br>
              <input type="radio" name="timeconstraint" value="until">
              Everyday Until<br>
              <input type="submit" value="Submit">
            </form>
          <?php }
          }
        else
        {
          header("Location: login.php"); // Redirect to the login page
        }
        ?>
        <h1>Current topic:<?=$selectedtopic?></h1>
    </div>
    
</body>

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
            if(isset($_POST['eventname']) && (isset($_POST['selectedtopic']))){
              $eventname = $_POST['eventname'];
            }
            if(isset($_POST['selecteddate'])){
              $selecteddate = $_POST['selecteddate'];
            }?>
            <h1>Name your Task:</h1>
                <input type="text" name="eventname"><br>
                <h1>Choose a Topic</h1>
            <?php
            $temp = $curLink->query("SELECT * FROM `topics`");
            $topics = $temp->fetch_all(MYSQLI_ASSOC);
              foreach ($topics as $t) { ?>
                <input type="submit" name="selectedtopic" value="<?= $t['topicname']?>">
              <?php }
          ?><?php
          }
          else{
            ?><h1>Choose a Time:</h1><br>
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
            if(isset($_POST['selectedtopic']) /*&& isset($eventname) && $eventname != '' && isset($selecteddate) && $selecteddate != ''*/){
              
              $eventname = $curLink->real_escape_string($_POST['eventname']);
              $selectedtopic = $curLink->real_escape_string($_POST['selectedtopic']);
              ?>
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
                
                </form><?php
            
          }
        else
        {
          header("Location: login.php"); // Redirect to the login page
        }
        ?>
    </div>
    
</body>

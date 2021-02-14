<head>
</head>
<body>
    <div>
    <?php require "dbconnection.php";
        session_start();
        // Check that they're logged in, otherwise redirect
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
        {
          $id = $_SESSION['id'];
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
            $temp = $curLink->query("SELECT * FROM `topics` WHERE user_id='$id'");
            $topics = $temp->fetch_all(MYSQLI_ASSOC);
              foreach ($topics as $t) { ?>
                <input type="submit" name="selectedtopic" value="<?= $t['topicname']?>">
              <?php }
          ?> <h1>Completion Time:</h1>
              <label for="minutes">Minutes</label>
              <select name="minutes" id="timeminutes">
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
              <select name="hours" id="timehours">
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
              </select>
    <?php
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
            if(isset($_POST['selectedtopic']) /*this breaks the code dont know why :( && isset($eventname) && $eventname != ''*/){
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
              ?></form><?php
            
          }
        else
        {
          header("Location: login.php"); // Redirect to the login page
        }
        ?>
    </div>
    
</body>

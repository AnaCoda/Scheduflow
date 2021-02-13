<head>
</head>
<body>
    <div>
    <?php require "dbconnection.php";
      
        session_start();
        // Check that they're logged in, otherwise redirect
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
        {
          if(isset($_POST['eventname'])){
            $eventname = $_POST['eventname'];
          }
          if(isset($_POST['selectedtopic']) && isset($eventname) && $eventname != null){
            ?><h1><?php echo $eventname?></h1>
            <?php
            $selectedtopic = $_POST['selectedtopic'];
            
            $curLink->query("INSERT INTO events (eventname, eventtime, eventtype) VALUES(
              $eventname,
              0,
              0
              ");
          }
          if(isset($_POST['selectedtopic'])){
            $selectedtopic = $_POST['selectedtopic'];
          }?>
          <h1>Step One: Name your Task:</h1></div>
          <input type="text" name="eventname">
          <h1>Step Two: Choose a Time:</h1><br>
          <input type="button" name="onday" value="For One Day">
          <input type="button" name="indefinite" value="Until Removed">
          <input type="button" name="until" value="Everyday Until">
          </div><br>
          <h1>Step Three: Choose a Topic</h1>
          <?php 
          $temp = $curLink->query("SELECT * FROM `topics`");
          $topics = $temp->fetch_all(MYSQLI_ASSOC);
          foreach ($topics as $t) { ?>
          <div> 
          <!--Jim-senpai pls add css and classes thx-->
          <?$t['topicname']?>
            <form action="eventadd.php" method="post">
              <input type="submit" name="selectedtopic" value="<?= $t['topicname']?>">
            </form>
          </div>
        <?php }
        }
        else
        {
          header("Location: login.php"); // Redirect to the login page
        }
        ?>
    </div>
    <h1><?php echo $selectedtopic?></h1>
</body>

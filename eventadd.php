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
            printf("Adding eventname");
            $eventname = $_POST['eventname'];
          }
          ?><h1>Event name <?php echo $eventname?></h1>
            <?php
          if(isset($_POST['selectedtopic']) && isset($eventname) && $eventname != ''){
            ?><h1>Event name <?php echo $eventname?></h1>
            <?php
            $eventname = $_POST['eventname'];
            $selectedtopic = $_POST['selectedtopic'];
            
            $curLink->query("INSERT INTO events (eventname, eventtime, eventtype) VALUES(
              $eventname,
              0,
              0
              ");
          }
          ?>
          <form action="eventadd.php" method="post" autocomplete="off">
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
            
              <input type="submit" name="selectedtopic" value="<?= $t['topicname']?>">
            
          </div>
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

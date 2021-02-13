<!DOCTYPE html>
<html>
<head>
  <title>
    Topic Creation
  </title>
</head>
<body>
  <!-- TOPICS LIST -->
  <div class="container">
    <div class="left">
    </div>
     <!-- form to add another topic -->
     <?php
    session_start();
    // Check that they're logged in, otherwise redirect
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
    {
        require "dbconnection.php";
        $id = $_SESSION['id'];
        $topicquery = $curLink->query("SELECT * FROM `topics` WHERE user_id='$id'");
        $topics = $topicquery->fetch_all(MYSQLI_ASSOC);

        if (isset($_POST['topicname']))
        {
            $topicname = $curLink->real_escape_string($_POST['topicname']);
            $curLink->query("INSERT INTO topics (user_id, topicname) VALUES(
                '".$_SESSION['id']."',
                '$topicname')") or die(mysqli_error($curLink));
            header('Refresh: 0');
        }
    }
    else
    {
        header("Location: login.php"); // Redirect to the login page
    }
    ?>
    <div class="right">
      <div id="topiclist">
        <?php 
          foreach ($topics as $t) { ?>
          <div class="topic-wrap" data-id="<?= $t['id'] ?>">
            <div class="topic-name"><?= $t['topicname'] ?></div>
          </div>
        <?php } ?>
      </div>
      <div>
      <h1>ADD A TOPIC</h1>
        <div id="topics">
          <form action="" method="post" class="form-horizontal" autocomplete="off">
          Topic Name:
          <input type="text"name="topicname">
          <input type="submit" value="Submit">
          </form> 
        </div>
      </div>
    </div>
  </div>
</body>
</html>
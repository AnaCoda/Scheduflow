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
    require "dbconnection.php";
    $topicquery = $curLink->query("SELECT * FROM `topics`");
    $topics = $topicquery->fetch_all(MYSQLI_ASSOC);

    if (isset($_POST['topicname']))
    {
        $topicname = $_POST['topicname'];
        $curLink->query("INSERT INTO topics (topicname) VALUES(
            '$topicname')") or die(mysqli_error($curLink));
        header('Refresh: 0');
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
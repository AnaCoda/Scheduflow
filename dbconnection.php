<?php
$dbpass = file_get_contents('password.txt');

$curLink = mysqli_connect("localhost", "root", $dbpass, "scheduflow_db") or die(printf(mysqli_error($curLink))); // Connect to database server(localhost) with username and password.
?>
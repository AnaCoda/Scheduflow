<?php
$dbpass = file_get_contents('password.txt');

$curLink = mysqli_connect("localhost", "root", $dpbass, "scheduflow_db") or die(printf(mysqli_error($curLink))); // Connect to database server(localhost) with username and password.
?>
<!-- This is the login page -->
<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">
    <script src="https://kit.fontawesome.com/38b15697bc.js" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar">
		<ul class="navicons topicons">
			<a href="/index.php"><li><i class="fas fa-home wideboi"></i></li></a>
			<a href="/schedule.php"><li><i class="fas fa-chart-bar wideboi"></i></li></a>
			<a href="/eventadd.php"><li><i class="fas fa-sticky-note"></i></li></a>
		</ul>
		<ul class="navicons boticons">
			<!-- <li><i class="fas fa-cog settings-icon"></i></li> -->
			<li>
				<a href="/profile.php">
					<div class="user-icon">
						<?php echo file_get_contents("img/profile-pic.svg");?>
					</div>
				</a>
			</li>
		</ul>
	</nav>
    <div id="wrap">
        <!-- start php code -->
        <?php require "dbconnection.php";
        session_start(); // Access session variables for login
        // If the form is posted with the values
        if (isset($_POST['uname']) && !empty($_POST['uname']) and isset($_POST['pass']) && !empty($_POST['pass'])) {
            // Connect to the SQL database (for the prototype, it's being hosted locally)
            $username = $curLink->real_escape_string($_POST['uname']); // Set variable for the username (escape string to prevent injection)
            $password = $curLink->real_escape_string(md5($_POST['pass']));  // Set variable for the password and hash it
            $search = $curLink->query("SELECT * FROM users WHERE username='" . $username . "' AND password='" . $password . "'") or die(mysqli_error($curLink));
            $match  = mysqli_num_rows($search); // Query user information so we can put them in session vars
            if ($match > 0) {
                $msg = 'Login Complete! Thanks';
                $_SESSION['loggedin'] = true;       // Set the session variables
                $_SESSION['username'] = $username;
                while ($row = mysqli_fetch_assoc($search)) {
                    $id = $row['id'];
                }
                $_SESSION['id'] = $id;
                //$addProfile = $curLink->query("INSERT INTO profiles (id, grade, name, subjects) VALUES (") or die(mysql_error()); 
                header("Location: profile.php"); // Redirect to the profile page
            } else {
                $msg = 'Login Failed! Please make sure that you enter the correct details and that you have activated your account.';
            }
        }

        ?>
        <!-- stop php code -->

        <!-- title and description -->
        <div class="container">
            <h3>Login</h3>
            <?php
            if (isset($msg)) {                                      // Check if $msg is not empty
                echo '<div class="statusmsg">' . $msg . '</div>';   // Display our error/success message and wrap it with a div with the class "statusmsg".
            }
            ?>

            <!-- start sign up form -->
            <form action="" method="post" role="form" autocomplete="off">
                <input type="text" name="uname" placeholder="Username" class="username form-input" /><br>
                <input type="password" name="pass" placeholder="Password" class="password form-input" /><br>
                <input type="submit" class="submit-button form-input" value="Login" />
            </form>    <!-- end sign up form -->
        </div>
    </div>
</body>

</html>
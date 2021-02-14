<!-- This is the registration page -->
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
        if (isset($_POST['uname']) && !empty($_POST['uname']) and isset($_POST['email']) && !empty($_POST['email'])) {
            // Form Submitted
            $name = $_POST['uname'];    // Turn our posts into local variables
            $email = $_POST['email'];
            $pass = $_POST['pass'];
            $pass2 = $_POST['pass2'];

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                // Return Error - Invalid Email
                $msg = 'The email you have entered is invalid, please try again.';
            } else {
                /*if(!(substr_compare($email, ".edu", -strlen(".edu")) === 0) && !(substr_compare($email, "educbe.ca", -strlen("educbe.ca")) === 0)) // Check if it's a known education email
                {
                    $msg = 'You must use a .edu email or other known education domain to sign up. Contact us if your school district does not use .edu emails.';
                }*/
                if ($pass != $pass2) {
                    // Return Error - Passwords do not match
                    $msg = 'The passwords you have entered do not match, please try again.';
                } else {
                    // Prevent SQL injection
                    $name = $curLink->real_escape_string($name);
                    $email = $curLink->real_escape_string($email);
                    $pass = md5($curLink->real_escape_string($pass)); // Encrypt the password
                    // Return Success - Valid Email
                    $msg = 'Your account has been made';
                    // Insert the values into the database
                    $curLink->query("INSERT INTO users (username, password, email) VALUES(
                        '$name', 
                        '$pass', 
                        '$email')") or die(mysqli_error($curLink));
                    $search = $curLink->query("SELECT * FROM users WHERE username='" . $name . "'") or die(mysqli_error($curLink));
                    while ($row = mysqli_fetch_assoc($search)) {
                        $id = $row['id'];
                    }

                    header("Location: login.php"); // Redirect to the login page
                    exit;
                }
            }
        }

        ?>
        <!-- stop php code -->

        <!-- title and description -->
        <div class="container">
            <h3>Signup Form</h3>
            <p>Please enter your name and email address to create your Scheduflow account.</p>
            <?php
            if (isset($msg)) {                                  // Check if $msg is not empty
                echo '<div class="statusmsg">' . $msg . '</div>'; // Display our error/success message and wrap it with a div with the class "statusmsg".
            }
            ?>
            <!-- start sign up form -->
            <form action="" method="post" role="form" autocomplete="off">
                <input type="text" name="uname" placeholder="Username" class="form-input" /><br>
                <input type="text" name="email" placeholder="Email" class="form-input" /><br>
                <input type="password" name="pass" placeholder="Password" class="form-input" /><br>
                <input type="password" name="pass2" placeholder="Confirm Password" class="form-input" /><br>

                <input type="submit" class="submit-button form-input" value="Sign up" />
            </form>
                <!-- end sign up form -->
        </div>
        <!-- end wrap div -->
</body>

</html>
<!-- This is the login page -->
<!DOCTYPE html>
<head>
    </head>
<body>
    </div>

    <div id="wrap">
         
        <!-- start php code -->
        <?php
        session_start(); // Access session variables for login
        // If the form is posted with the values
        if(isset($_POST['uname']) && !empty($_POST['uname']) AND isset($_POST['pass']) && !empty($_POST['pass']))
        {
            $dbpass = file_get_contents('password.txt');
            // Connect to the SQL database (for the prototype, it's being hosted locally)
            $curLink = mysqli_connect("localhost", "root", $dbpass, "scheduflow_db") or die(printf(mysqli_error($curLink))); // Connect to database server(localhost) with username and password.
            $username = $curLink->real_escape_string($_POST['uname']); // Set variable for the username (escape string to prevent injection)
            $password = $curLink->real_escape_string(md5($_POST['pass']));  // Set variable for the password and hash it
            $search = $curLink->query("SELECT * FROM users WHERE username='".$username."' AND password='".$password."'") or die(mysqli_error($curLink)); 
            $match  = mysqli_num_rows($search); // Query user information so we can put them in session vars
            if($match > 0){
                $msg = 'Login Complete! Thanks';
                $_SESSION['loggedin'] = true;       // Set the session variables
                $_SESSION['username'] = $username;
                while($row = mysqli_fetch_assoc($search)) {
                    $id = $row['id'];
                }
                $_SESSION['id'] = $id;
                //$addProfile = $curLink->query("INSERT INTO profiles (id, grade, name, subjects) VALUES (") or die(mysql_error()); 
                header("Location: profile.php"); // Redirect to the profile page
            }else{
                $msg = 'Login Failed! Please make sure that you enter the correct details and that you have activated your account.';
            }
        }
                 
        ?>
        <!-- stop php code -->
     
        <!-- title and description -->   
        <br><br>
        <div class="container">
        <div class="text-center">
        <h3>Login</h3>
           <?php 
            if(isset($msg)){                                  // Check if $msg is not empty
                echo '<div class="statusmsg">'.$msg.'</div>'; // Display our error/success message and wrap it with a div with the class "statusmsg".
            } 
        ?>
        <!-- start sign up form -->  
        <form action="" method="post" class="form-horizontal" role="form" autocomplete="off">
        <div class="form-group d-flex justify-content-center align-items-center container">
        <div style="width:500px" class="text-center">
            <input type="text" name="uname" placeholder="Username" class="form-control" /><br>
            <input type="password" name="pass" placeholder="Password" class="form-control" /><br>
             
            <input type="submit" class="submit_button btn btn-primary" value="Login" />
        </div>
        </div>
        </form>
        <!-- end sign up form -->
        </div>
        
    </div>
    
</body>
</html>
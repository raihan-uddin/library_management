<?php
if (!isset($_SESSION)) { session_start(); }
include_once("config.php"); //Establishing connection with our database
error_reporting(-1);
$error = ""; //Variable for storing our errors.

unset($_SESSION["logstatus"]);
unset($_SESSION["username"]);

if (isset($_POST["submit"])) {
    if (empty($_POST["username"]) || empty($_POST["password"])) {
        $error = "Both fields are required.";
    } else {
        // Define $username and $password
        $username = $_POST['username'];
        $password = $_POST['password'];

        // To protect from MySQL injection
        $password = md5($password);

        //Check username and password from database
        $sql = "SELECT id FROM user WHERE username='$username' and password='$password'";
        $result = mysqli_query($connection, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        //If username and password exist in our database then create a session.
        //Otherwise echo error.
        if (mysqli_num_rows($result) == 1) {
            $_SESSION['logstatus'] = 1; // Initializing Session
            $_SESSION['username'] = $username; // Initializing Session
            header("location: admin.php"); // Redirecting To Other Page
        } else {
            $error = "Incorrect username or password.";
        }

    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/login.css">
    <title>Login</title>
</head>
<body>

<h2>Login Form</h2>

<form method="post">
    <div class="imgcontainer">
        <img src="img/img_avatar2.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
        <label for="uname"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="username" required>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" required>

        <button type="submit" name="submit">Login</button>
        <span style="text-align: center; color: red;">
            <?php
            if (isset($error))
                echo $error;
            ?>
        </span>
    </div>
</form>

</body>
</html>

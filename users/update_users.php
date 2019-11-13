<link rel="stylesheet" href="../css/bootstrap.min.css">
<?php

include_once("../config.php"); //Establishing connection with our database
$error = ""; //Variable for storing our errors.
if (isset($_POST["submit"])) {
    if (empty($_POST["username"]) || empty($_POST["password"])) {
        $error = "Both fields are required.";
    } else {
        // Define $username and $password
        $id = $_POST['id'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // To protect from MySQL injection
        $password = md5($password);

        $sql = "UPDATE user SET email = '$email', password ='$password' where id=$id";
        $result = mysqli_query($connection, $sql);
        var_dump($sql);

        //If username and password exist in our database then create a session.
        //Otherwise echo error.
        if ($result) {
            header("location: index.php"); // Redirecting To Other Page
        } else {
            $error = "Please try again!";
        }

    }
}
if (isset($_GET['edit'])) {
    $user_id = $_GET['edit'];
    //Check username and password from database
    $sql = "SELECT * FROM user WHERE id=$user_id";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if (mysqli_num_rows($result) == 1) {
        ?>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item" aria-current="page">Users</li>
                <li class="breadcrumb-item active" aria-current="page">Update User</li>
            </ol>
        </nav>
        <form method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="hidden" class="form-control" id="id" name="id" value="<?= $_GET['edit'] ?>">
                <input type="text" class="form-control" id="username" name="username" value="<?= $row['username'] ?>" readonly required>
            </div>
            <div class="form-group">
                <label for="email">Email address:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $row['email'] ?>">
            </div>
            <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-success" name="submit">Save</button>

            <span style="text-align: center; color: red;">
            <?php
            if (isset($error))
                echo $error;
            ?>
        </span>
        </form>
        <?php
    }
}
?>
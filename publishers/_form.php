<link rel="stylesheet" href="../css/bootstrap.min.css">
<?php

include_once("../config.php"); //Establishing connection with our database
$error = ""; //Variable for storing our errors.
if (isset($_POST["submit"])) {
    if (empty($_POST["publication_name"])) {
        $error = "Publication Name name field required.";
    } else {
        $publications = $_POST['publication_name'];
        $address = $_POST['address'];
        $sql = "INSERT INTO publications (publication_name, address) VALUES ('$publications', '$address')";
        $result = mysqli_query($connection, $sql);
        if ($result) {
            header("location: index.php"); // Redirecting To Other Page
        } else {
            $error = "Please try again!";
        }

    }
}
?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item" aria-current="page"><a href="index.php">Publishers</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create Publishers</li>
    </ol>
</nav>
<form method="post">
    <div class="form-group">
        <label for="username">Publication Name:</label>
        <input type="text" class="form-control" id="publication_name" name="publication_name" required>
    </div>
    <div class="form-group">
        <label for="email">Address:</label>
        <textarea class="form-control" rows="5" id="address" name="address"></textarea>
    </div>
    <button type="submit" class="btn btn-success" name="submit">Save</button>

    <span style="text-align: center; color: red;">
            <?php
            if (isset($error))
                echo $error;
            ?>
        </span>
</form>

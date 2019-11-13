<link rel="stylesheet" href="../css/bootstrap.min.css">
<?php

include_once("../config.php"); //Establishing connection with our database
$error = ""; //Variable for storing our errors.
if (isset($_POST["submit"])) {
    if (empty($_POST["category_name"])) {
        $error = "Category name field required.";
    } else {
        $category_name = $_POST['category_name'];
        $sql = "INSERT INTO category (category_name) VALUES ('$category_name')";
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
        <li class="breadcrumb-item" aria-current="page"><a href="index.php">Category</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create Category</li>
    </ol>
</nav>
<form method="post">
    <div class="form-group">
        <label for="username">Category Name:</label>
        <input type="text" class="form-control" id="category_name" name="category_name" required>
    </div>
    <button type="submit" class="btn btn-success" name="submit">Save</button>

    <span style="text-align: center; color: red;">
            <?php
            if (isset($error))
                echo $error;
            ?>
        </span>
</form>

<link rel="stylesheet" href="../css/bootstrap.min.css">
<?php

include_once("../config.php"); //Establishing connection with our database
$error = ""; //Variable for storing our errors.
if (isset($_POST["submit"])) {
    if (empty($_POST["category_name"])) {
        $error = "Category name field required.";
    } else {
        $category_name = $_POST['category_name'];
        $id = $_POST['id'];
        $sql = "UPDATE category SET category_name = '$category_name'  where id=$id";
        $result = mysqli_query($connection, $sql);
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
    $id = $_GET['edit'];
    //Check username and password from database
    $sql = "SELECT * FROM category WHERE id=$id";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if (mysqli_num_rows($result) == 1) {
        ?>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item" aria-current="page"><a href="index.php">Category</a></li>
                <li class="breadcrumb-item active" aria-current="page">Update Category</li>
            </ol>
        </nav>
        <form method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="hidden" class="form-control" id="id" name="id" value="<?= $_GET['edit'] ?>">
                <input type="text" class="form-control" id="category_name" name="category_name" value="<?= $row['category_name'] ?>" required>
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
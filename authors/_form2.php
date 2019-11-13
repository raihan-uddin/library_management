<link rel="stylesheet" href="../css/bootstrap.min.css">
<?php

include_once("../config.php"); //Establishing connection with our database
$error = ""; //Variable for storing our errors.
if (isset($_POST["submit"])) {
    if (empty($_POST["author_name"])) {
        $error = "Author name field required.";
    } else {
        $author_name = $_POST['author_name'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $id = $_POST['id'];
        $sql = "UPDATE authors SET author_name = '$author_name', email='$email', address = '$address'  where id=$id";
        $result = mysqli_query($connection, $sql);
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
    $sql = "SELECT * FROM authors WHERE id=$id";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if (mysqli_num_rows($result) == 1) {
        ?>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item" aria-current="page"><a href="index.php">Authors</a></li>
                <li class="breadcrumb-item active" aria-current="page">Update author</li>
            </ol>
        </nav>
        <form method="post">
            <div class="form-group">
                <label for="author_name">Author Name:</label>
                <input type="hidden" class="form-control" id="id" name="id" value="<?= $_GET['edit'] ?>">
                <input type="text" class="form-control" id="author_name" name="author_name"
                       value="<?= $row['author_name'] ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" class="form-control" id="email" name="email" value="<?= $row['email'] ?>">
            </div>
            <div class="form-group">
                <label for="email">Address:</label>
                <textarea class="form-control" rows="5" id="address" name="address"><?= $row['address'] ?></textarea>
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
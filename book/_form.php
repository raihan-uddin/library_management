<link rel="stylesheet" href="../css/bootstrap.min.css">
<?php

include_once("../config.php"); //Establishing connection with our database
$error = ""; //Variable for storing our errors.
if (isset($_POST["submit"])) {
    if (empty($_POST["category_id"]) && empty($_POST["title"])) {
        $error = "Category & Title field required";
    } else {
        $category_id = $_POST['category_id'];
        $title = $_POST['title'];
        $short_description = $_POST['short_description'];
        $edition = $_POST['edition'];
        $no_of_pages = $_POST['no_of_pages'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $publication_date = date("Y-m-d", strtotime($_POST['publication_date']));
        $author_id = $_POST['author_id'];
        $publication_id = $_POST['publication_id'];
        $sql = "INSERT INTO book (category_id, title, short_description, edition, no_of_pages, price, quantity, publication_date, author_id, publication_id) 
VALUES ($category_id, '$title', '$short_description', '$edition', '$no_of_pages', '$price', '$quantity', '$publication_date', '$author_id', '$publication_id')";
        echo $sql;
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
        <li class="breadcrumb-item" aria-current="page"><a href="index.php">Book</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create Book</li>
    </ol>
</nav>
<form method="post">
    <div class="form-group">
        <label for="category_id">Category Name:</label>
        <select class="form-control" name="category_id" required>
            <option value="">Select</option>
            <?php
            $sql = "SELECT * FROM category ORDER BY category_name";
            $result = mysqli_query($connection, $sql);
            while ($row = mysqli_fetch_array($result)) {
                $id = $row['id'];
                $name = $row['category_name'];
                echo "<option value='$id'>$name</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" class="form-control" id="title" name="title" required>
    </div>
    <div class="form-group">
        <label for="short_description">Short Description:</label>
        <textarea class="form-control" rows="5" id="short_description" name="short_description"></textarea>
    </div>
    <div class="form-group">
        <label for="edition">Edition:</label>
        <input type="number" class="form-control" id="edition" name="edition">
    </div>
    <div class="form-group">
        <label for="no_of_pages">No Of Pages:</label>
        <input type="number" class="form-control" id="no_of_pages" name="no_of_pages">
    </div>
    <div class="form-group">
        <label for="price">Price:</label>
        <input type="number" class="form-control" id="price" name="price">
    </div>
    <div class="form-group">
        <label for="quantity">Quantity:</label>
        <input type="number" class="form-control" id="quantity" name="quantity">
    </div>
    <div class="form-group">
        <label for="publication_date">Publication Date:</label>
        <input type="date" class="form-control" id="publication_date" name="publication_date">
    </div>
    <div class="form-group">
        <label for="author_id">Author:</label>
        <select class="form-control" name="author_id" required>
            <option value="" >Select</option>
            <?php
            $sql = "SELECT * FROM authors ORDER BY author_name";
            $result = mysqli_query($connection, $sql);
            while ($row = mysqli_fetch_array($result)) {
                $id = $row['id'];
                $name = $row['author_name'];
                echo "<option value='$id'>$name</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="publication_id">Publication Name:</label>
        <select class="form-control"  name="publication_id" required>
            <option value="">Select</option>
            <?php
            $sql = "SELECT * FROM publications ORDER BY publication_name";
            $result = mysqli_query($connection, $sql);
            while ($row = mysqli_fetch_array($result)) {
                $id = $row['id'];
                $name = $row['publication_name'];
                echo "<option value='$id'>$name</option>";
            }
            ?>
        </select>
    </div>

    <button type="submit" class="btn btn-success" name="submit">Save</button>

    <span style="text-align: center; color: red;">
            <?php
            if (isset($error))
                echo $error;
            ?>
        </span>
</form>

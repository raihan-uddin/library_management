<?php
if (!isset($_SESSION)) {
    session_start();
}
date_default_timezone_set('Asia/Dhaka');
if (isset($_SESSION["logstatus"]) && $_SESSION["logstatus"] == 1) {
    if (isset($_REQUEST['logout'])){
        unset($_SESSION["logstatus"]);
        unset($_SESSION["username"]);
        header("location: index.php"); // Redirecting To Other Page
    }
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <title>Admin Panel</title>
    </head>
    <body>

    <ul>
        <li><a class="active" href="#">Library Management</a></li>
        <li><a href="book/index.php" target="body">Book</a></li>
        <li><a href="category/index.php" target="body">Category</a></li>
        <li><a href="authors/index.php" target="body">Author</a></li>
        <li><a href="publishers/index.php" target="body">Publishers</a></li>
        <li><a href="users/index.php" target="body">Users</a></li>
        <li><a href="?logout">Logout</a></li>
    </ul>

    <div style="margin-left:25%;padding:1px 16px;height:1000px;">
        <div class="iframe-container">
            <iframe id="iframe" name="body">

            </iframe>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
    </body>
    </html>
    <?php
} else {
    echo "<span style='color: red;'> Sorry you're not authorized!</span>";
}
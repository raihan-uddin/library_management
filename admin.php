<?php
if (!isset($_SESSION)) {
    session_start();
}
date_default_timezone_set('Asia/Dhaka');
if (isset($_SESSION["logstatus"]) && $_SESSION["logstatus"]   == 1) {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/style.css">
        <title>Admin Panel</title>
    </head>
    <body>

    <ul>
        <li><a class="active" href="#">Library Management</a></li>
        <li><a href="#contact" target="body">Book</a></li>
        <li><a href="#news" target="body">Category</a></li>
        <li><a href="#about" target="body">Author</a></li>
        <li><a href="#about" target="body">Publishers</a></li>
        <li><a href="users.php" target="body">Users</a></li>
    </ul>

    <div style="margin-left:25%;padding:1px 16px;height:1000px;">
        <div class="iframe-container">
            <iframe id="iframe" name="body">

            </iframe>
        </div>
    </div>


    </body>
    </html>
    <?php
} else {
    echo "<span style='color: red;'> Sorry you're not authorized!</span>";
}
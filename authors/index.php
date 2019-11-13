<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Authors</li>
    </ol>
</nav>
<div>
    <a class="btn btn-success text-white" href="_form.php"> Create New</a>
    <form class="example" method="post" style="margin:auto;max-width:300px">
        <input type="text" placeholder="Search.." name="search" required>
        <button type="submit" name="submit"><i class="fa fa-search"></i></button>
    </form>
</div>
<table class="table table-striped table-hover table-condensed">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Author Name</th>
        <th scope="col">Email</th>
        <th scope="col">Address</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
    include_once("../config.php"); //Establishing connection with our database
    if (isset($_GET['delete'])) {
        $delete = $_GET['delete'];
        $sql = "DELETE FROM authors WHERE id=$delete";
        $result = mysqli_query($connection, $sql);
        header("location: index.php"); // Redirecting To Other Page
    }
    if (isset($_POST['submit'])) {
        $search = $_POST['search'];
        $sql = "SELECT * FROM authors WHERE author_name LIKE '%$search%' OR email LIKE '%$search%' OR address LIKE '%$search%'";
    } else {
        $sql = "SELECT * FROM authors ";
    }
    $result = mysqli_query($connection, $sql);
    $i = 0;
    while ($row = mysqli_fetch_array($result)) {
        ?>
        <tr>
            <th scope="row"><?= ++$i; ?></th>
            <td><?= $row['author_name']; ?></td>
            <td><?= $row['email']; ?></td>
            <td><?= $row['address']; ?></td>
            <td>
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a class="btn btn-primary text-white" href="_form2.php?edit=<?= $row['id'] ?>">Edit</a>
                    <a class="btn btn-danger text-white" href="?delete=<?= $row['id'] ?>">Delete</a>
                </div>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
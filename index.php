<?php
session_start();

if (!isset($_SESSION["id_users"])) {
    header("Location: login.php"); // Redirect to the login page if not logged in
    exit();
}

require_once('config.php');

$sql = "SELECT * FROM tb_artikel";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Article Management</title>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
<nav class="navbar pt-3 pb-3" style="background-color: #1E1E1E;">
  <div class="container-fluid" >
    <h1 class="text-light">e-Mading</h1>
    <div class="d-flex">
      <a href="logout.php" class="btn fw-bold" style="background-color: white;">Logout</a>
    </div>
  </div>
</nav>
    
    <div class="container mt-5">
        <h1 class="mb-4">Article List</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["judul_artikel"] . "</td>";
                        // echo "<td style='width: 300px;'>" . $row["header"] . "</td>";
                        echo "<td>" . $row["author"] . "</td>";
                        echo "<td><a href='edit.php?id_artikel=" . $row["id_artikel"] . "'>Edit</a> | <a href='delete.php?id_artikel=" . $row["id_artikel"] . "'>Delete</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No articles found</td></tr>";
                }
                ?>
        </table>
        <a class="btn text-light btn-success" href="add.php">Add New Article</a>
        <a class="btn text-light" style="background-color: #1E1E1E;" href="home_user.php">User View</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>s
<?php
session_start();

if (!isset($_SESSION["id_users"])) {
    header("Location: login.php"); // Redirect to the login page if not logged in
    exit();
}

require_once('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];

    $sql = "DELETE FROM tb_artikel WHERE id_artikel = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    $id = $_GET["id_artikel"];
    $sql = "SELECT * FROM tb_artikel WHERE id_artikel = $id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        echo "Article not found.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Delete Article</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container mt-5">
        <h1>Delete Article</h1>
        <p>Apakah anda yakin ingin menghapus artikel</p>
        <p class="font-weight-bold"><?php echo $row['judul_artikel']; ?></p>
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $row["id_artikel"]; ?>">
            <input type="submit" class="btn btn-danger" value="Delete">
        </form>
        <a class="btn btn-secondary mt-3" href="index.php">Cancel</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>
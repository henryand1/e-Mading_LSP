<?php
session_start();

if (!isset($_SESSION["id_users"])) {
    header("Location: login.php"); // Redirect to the login page if not logged in
    exit();
}

require_once('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id_artikel"];
    $title = $_POST["judul_artikel"];
    $article = $_POST["isi_artikel"];
    $description = $_POST["description"];
    $status = $_POST["status_publish"];
    $author = $_POST["author"];
    $updated_at = date("Y-m-d");

    // Initialize $picture to an empty string

    if ($_FILES["foto-new"]["name"] != "") {
        // New image handling
        $picture = $_FILES["foto-new"]["name"];
        $folder = "./images/" . $picture;
        move_uploaded_file($_FILES["foto-new"]["tmp_name"], $folder);
    } else {
        $picture = $_POST["foto"];
    }

    $sql = "UPDATE tb_artikel
            SET judul_artikel = '$title', isi_artikel = '$article', header = '$description',
                foto = '$picture', status_publish = '$status', updated_at = '$updated_at', author = '$author'
            WHERE id_artikel = $id";

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
    <title>Edit Article</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
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
        <h1>Tambah Artikel</h1>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_artikel" value="<?php echo $row["id_artikel"]; ?>">
            <div class="form-group mt-3">
                <label for="title">Judul</label>
                <input type="text" class="form-control" id="judul_artikel" name="judul_artikel" value="<?php echo $row["judul_artikel"]; ?>" required>
            </div>

            <div class="form-group mt-4">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" rows="3" required><?php echo $row["header"]; ?></textarea>
            </div>

            <div class="form-group mt-4">
                <label for="article">Article:</label>
                <textarea class="summernote" id="summernote" name="isi_artikel" rows="6"  required><?php echo $row["isi_artikel"]; ?></textarea>
            </div>

            <div class="form-group mt-4">
                <label for="author">Author:</label>
                <input type="text" class="form-control" id="author" name="author" value="<?php echo $row["author"]; ?>" required>
            </div>
            
            <div class="form-group mt-4">
                <label for="status_publish">Status</label>
                <select class="form-control" id="status_publish" name="status_publish" required>
                    <option value="publish" <?php if ($row["status_publish"] == 1) echo "selected"; ?>>Published</option>
                    <option value="draft" <?php if ($row["status_publish"] == 0) echo "selected"; ?>>Draft</option>
                </select>
            </div>


            <div class="form-group mt-4">
                <label for="foto">Foto </label><br />
                <input type="text" class="form-control" id="foto" name="foto" value="<?php echo $row['foto']; ?>" required>
                <img src="./images/<?php echo $row['foto']; ?>" class="card-img-top fixed-height-image mt-2" alt="Article Image">
                <label class="mt-5">Choose a new photo</label></br>
                <input type="file" class="form-control-file mt-2" id="foto-new" name="foto-new">
            </div>

            <div class="text-center mt-5 mb-5">
                <input type="submit" class="btn btn-primary" value="Save">
                <a class="btn btn-secondary" href="index.php">Back to List</a>
            </div>
        </form>
        <!-- <a class="btn btn-secondary" href="index.php">Back to List</a> -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script>
        $('#summernote').summernote({
            placeholder: '......',
            tabsize: 2,
            height: 200
        });
    </script>
</body>

</html>
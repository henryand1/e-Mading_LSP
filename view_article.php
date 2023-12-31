<?php
session_start();

if (!isset($_SESSION["id_users"])) {
    header("Location: login.php"); // Redirect to the login page if not logged in
    exit();
}

require_once('config.php');

// Check if 'id' parameter is set in the URL
if (isset($_GET["id_artikel"])) {
    $article_id = $_GET["id_artikel"];

    // Retrieve the article details from the database
    $sql = "SELECT * FROM tb_artikel WHERE id_artikel = $article_id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $title = $row["judul_artikel"];
        $foto = $row["foto"];
        $content = $row["isi_artikel"];
        $author = $row["author"];
        $publish_date = $row["created_at"];

        // Display the article details
?>
        <!DOCTYPE html>
        <html>

        <head>
            <title><?php echo $title; ?></title>
            <!-- Add Bootstrap CSS -->
            <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
            <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        </head>

        <body>
            <nav class="navbar pt-3 pb-3" style="background-color: #1E1E1E;">
            <div class="container-fluid" >
                <h1 class="text-light" style="font-family: Montserrat">e-Mading</h1>
                <div class="d-flex">
                <a href="logout.php" class="btn fw-bold" style="background-color: white;">Logout</a>
            </div>
            </nav>
            <div class="container mt-5">
                <h1><?php echo $title; ?></h1>
                <p>Pengarang: <?php echo $author; ?></p>
                <img src="./images/<?php echo $foto ?>" class="fixed-height-image mt-3"> 
                <hr>
                <div><?php echo $content; ?></div>
                <hr>
                <p>Publish Date: <?php echo $publish_date; ?></p>
                <?php if ($_SESSION["id_users"] == 1) : ?>
                    <a class="btn btn-secondary mt-4 mb-5" href="index.php">Back to Article List</a>
                <?php else : ?>
                    <a class="btn btn-secondary mt-4 mb-5" href="home_user.php">Back to Article List</a>
                <?php endif; ?>
            </div>
            <style>
                .fixed-height-image {
                    height: 200px; 
                    object-fit: cover; 
                }
            </style>
        </body>

        </html>
<?php
        exit();
    } else {
        // Article not found
        echo "Article not found. <a href='index.php'>Back to Article List</a>";
    }
} else {
    // 'id' parameter not set
    echo "Invalid request. <a href='index.php'>Back to Article List</a>";
}
?>
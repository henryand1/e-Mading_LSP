<?php
require_once('config.php');

$sql = "SELECT * FROM tb_artikel WHERE status_publish = 'publish'";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Article List</title>
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
    <div style="background-color: #D9D9D9;height:300px">
        <h3 class="text-center p-5" style="color: #1E1E1E;font-family: Montserrat">Selamat datang di,</h3>
        <h1 class="text-center" style="color: #1E1E1E;font-size:60px;font-family: Montserrat">e-Mading JeWePe</h1>
    </div>
    <div class="container mt-5">
        <h1 style="font-family: Montserrat">List Artikel</h1>
        <div class="row mt-5">
            <?php
            while ($row = $result->fetch_assoc()) {
            ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 fixed-height-card">
                        <!-- Use $row['foto'] to get the image filename from the database -->
                        <img src="./images/<?php echo $row['foto']; ?>" class="card-img-top fixed-height-image" alt="Article Image">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?php echo $row['judul_artikel']; ?></h5>
                            <p class="card-text flex-grow-1"><?php echo $row['header']; ?></p>
                            <a href="view_article.php?id_artikel=<?php echo $row['id_artikel']; ?>" class="btn bg-dark mt-auto text-light">Read More</a>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <style>
        .fixed-height-image {
            height: 200px; 
            object-fit: cover; 
        }
        .fixed-height-card {
            height: 500px; /* Set the desired height for the cards */
        }
    </style>
</body>

</html>

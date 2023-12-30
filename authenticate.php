<?php
require_once('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM tb_users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $storedPassword = $row["password"];
        print_r($row);

        if ($password === $storedPassword) {
            // Authentication successful
            session_start();
            $_SESSION["id_users"] = $row["id_users"];
            $_SESSION["username"] = $row["username"];
            if ($row["id_users"] == 1) {
                header("Location: index.php"); // Redirect to the dashboard
            } else {
                header("Location: home_user.php");
            }
            exit();
        } else {
            echo "Invalid password. <a href='login.php'>Try Again</a>";
        }
    } else {
        echo "User not found. <a href='login.php'>Try Again</a>";
    }
}
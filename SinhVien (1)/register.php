<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['user_name'];
    $password = $_POST['password'];

    $sql = "INSERT INTO users (user_name, password) VALUES ('$username', '$password')";

    if (mysqli_query($conn, $sql)) {
        header("location: index.html");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

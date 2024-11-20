<?php

    $conn = new mysqli("localhost", "root", "","restaurant");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $valid_username = 'admin';
    $valid_password = 'admin1234';

    if ($username === $valid_username && $password === $valid_password) {
        header('Location: admin.html');
        exit;
    } else {
        echo '<script>alert("Invalid username or password. Please try again.");';
        echo 'window.location.href = "adminLogin.html";</script>';
        exit;
    }
} else {
    header('Location: adminLogin.html');
    exit;
}
?>

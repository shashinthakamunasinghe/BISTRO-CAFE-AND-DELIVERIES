<?php
$conn = new mysqli("localhost", "root", "", "restaurant");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $food_name = mysqli_real_escape_string($conn, $_POST['food_name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);

    $sql = "INSERT INTO price (food_name, description, price) VALUES ('$food_name', '$description', '$price')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

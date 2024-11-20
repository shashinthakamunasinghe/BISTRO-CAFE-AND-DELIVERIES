<?php
// Database connection details
$servername = "localhost"; // change if necessary
$username = "root"; // change if necessary
$password = ""; // change if necessary
$dbname = "restaurant"; // change if necessary

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$city = $_POST['city'];

// Use prepared statements to prevent SQL injection
$stmt = $conn->prepare("INSERT INTO delivery_details (fullname, email, phone, address, city) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $fullname, $email, $phone, $address, $city);

if ($stmt->execute()) {
    // Redirect to another HTML file upon successful insertion
    header("Location: payementindex.html");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

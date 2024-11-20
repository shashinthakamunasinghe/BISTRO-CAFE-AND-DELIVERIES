<?php
// Database configuration
$servername = "localhost";
$username = "root"; // your database username
$password = ""; // your database password
$dbname = "restaurant";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Validate form data
    if (strlen($name) < 4) {
        die("Please enter at least 4 characters for your name.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Please enter a valid email address.");
    }

    if (strlen($subject) < 8) {
        die("Please enter at least 8 characters for the subject.");
    }

    if (empty($message)) {
        die("Please write a message.");
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO contact (name, email, subject, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    // Execute the statement
    if ($stmt->execute()) {
        echo "your message has been received";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>



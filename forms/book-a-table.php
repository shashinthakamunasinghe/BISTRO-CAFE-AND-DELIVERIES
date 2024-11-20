<?php
$servername = "localhost"; 
$username = "root";
$password = "";
$dbname = "restaurant";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Prepare a SQL statement
$sql = "INSERT INTO reservations (name, email, phone, date, time, people, message) VALUES (?, ?, ?, ?, ?, ?, ?)";

// Prepare the SQL statement
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssis", $_POST['name'], $_POST['email'], $_POST['phone'], $_POST['date'], $_POST['time'], $_POST['people'], $_POST['message']);

// Execute the statement
if ($stmt->execute()) {
    // Redirect to another HTML file upon successful insertion
    header("Location: reservationPayment.html");
    /*echo "Your booking request was sent. We will call back or send an Email to confirm your reservation. Thank you!.";*/
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();


?>

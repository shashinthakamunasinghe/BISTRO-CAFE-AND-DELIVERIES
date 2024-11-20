<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="10">
    <title>Orders-Admin</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div style="padding-left: 100px; padding-right: 100px;">
        <div style="width: 50%; float: left; text-align: left;">
            <h1>Bistro Cafe & Delivers</h1>
        </div>
        <div style="width: 50%; float: right;">
            <nav class="navi">
                <ul>
                    <li><a href="account.php"><img src="Icons/account.svg" class="account" title="Log Out"></a></li>
                    <li><a href="index.php">Website</a></li>
                    <li><a href="admin.html">Dashboard</a></li>
                    <li><a href="orders.php" target="_blank">Orders</a></li>
                    <li><a href="reservation.php">Reservation</a></li>
                    <li><a href="messages.php">Messages</a></li>                
                </ul>
            </nav>
        </div>
    </div>
    <div id="datetime" style="text-align: center; font-size: 14px;">
        <script>
            function updateDateTime() {
              let now = new Date();
        
              let date = now.toLocaleDateString('en-US');
              let time = now.toLocaleTimeString('en-US');
        
              document.getElementById('datetime').innerHTML = `${date} ${time}`;
            }
        
            setInterval(updateDateTime, 1000);
        
            updateDateTime();
        </script>
    </div>
    <br>
    <div class="top-nav">
        <h1>Orders<span class="title"> List</span></h1>
    </div>


    <?php

        $conn = new mysqli("localhost", "root", "","restaurant");

        if (!$conn) {
        die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "SELECT reg_date, id, fullname, Email, Phone, address, city FROM delivery_details";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        echo "<table><tr><th>Date/Time</th><th>Order ID</th><th>Name</th><th>Email</th><th>Phone Number</th><th>Order Foods<br>ID</th><th>Food Name</th><th>Price</th><th></th></tr>";
        
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["reg_date"]."</td><td>".$row["id"]."</td><td>".$row["fullname"]."</td><td>".$row["Email"]."</td><td>".$row["Phone"]."</td><td>".$row["address"]."</td><td>".$row["city"]."</td><td><a href='?id=".$row["id"]."'><button>Delete</button></a></td></tr>";
        }

        if(!empty($_GET["id"])){
            $sql = "DELETE FROM delivery_details WHERE id=".$_GET["id"];
            mysqli_query($conn,$sql);
        }

        echo "</table>";
        } else {
        echo "0 results";
        }
        $conn->close();
    ?>
</body>
</html>
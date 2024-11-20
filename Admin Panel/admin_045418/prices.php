<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Price-list</title>
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
        <h1>Food <span class="title">Price</span> List</h1>
    </div>
    <div><a href="update.php"><button style="width: 80%; margin-left: 135px; padding:5px; font-weight:bold;
    background-color:#cda45e;
    border:none;
    border-radius:10px;

    ">Add/Update Foods</button></a></div>
    <?php

        $conn = new mysqli("localhost", "root", "","restaurant");

        if (!$conn) {
        die("Connection failed: " . $conn->connect_error);
        }
        #echo "Connected successfully";
        $sql = "SELECT id, food_Name, description, price FROM price";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        echo "<table><tr><th>Food Name</th><th>Description</th><th>Price</th><th></th></tr>";
        
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["food_Name"]."</td><td>".$row["description"]."</td><td>".$row["price"]."</td><td><a href='?id=".$row["id"]."'><button>Delete</button></a></td></tr>";
        }

        if(!empty($_GET["id"])){
            $sql = "DELETE FROM price WHERE id=".$_GET["id"];
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
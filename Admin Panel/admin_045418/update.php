<!DOCTYPE html>
<html lang="en">
<head>
    <?php

        $conn = new mysqli("localhost", "root", "","restaurant");

        if (!$conn) {
        die("Connection failed: " . $conn->connect_error);
        }

    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update price</title>
    <link rel="stylesheet" href="update.css">
</head>
<body>
    <div class="window">
        <div class="box">        
            <div class="form-popup" id="myForm">
            <form action="action.php" class="form-container" method="POST">
                <h1>Add Foods to Database</h1>
        
                <label for="food_name"><b>Food Name</b></label>
                <input type="text" placeholder="Food Name" name="food_name" required>
                <br>
                <label for="Description"><b>Description</b></label><br>
                <input type="text" placeholder="Description" name="description" required><br>
        
                <label for="price"><b>Price</b></label>
                <input type="int" placeholder="Food Price" name="price" required>
                <div style="margin-left: 35px;">
                <input type="submit" class="btn" name="save" value="Save" class="btn" >
                <input type="reset" class="btn" name="reset" value="Clear" class="btn" >
                </div>
            </form>  
            </div>
        </div>
        <div class="box">
            <h1>Update Prices</h1>
            <form method="POST">
                    <label for="foodid"><b>Select Food</b></label><br>
                        <select name="foodid" class="price" style="width: 480px;">
                            <?php

                                $sql="SELECT * FROM price";
                                $result=mysqli_query($conn,$sql);

                                while($row=mysqli_fetch_array($result)){
                                    echo "<option value=".$row["id"].">".$row["food_name"]."</option>";
                                }

                            ?>
                        </select><br>
                        <label><b>Price</b></label><br>
                        <input type="number" name="price" required placeholder="Enter Price" class="price"></td>
                        <input type="submit" value="Update" name="update" style="width:480px" class="btn">
            </form>
            <?php
                if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["update"])) {
                    $id = $_POST["foodid"];
                    $new_price = $_POST["price"];

                    // Validate inputs (example: numeric validation for price)
                    if(!is_numeric($new_price)) {
                        die("Error: Price must be a number.");
                    }

                    // Perform the update
                    $sql = "UPDATE price SET price = ? WHERE id = ?";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, "ii", $new_price, $id);
                    $result = mysqli_stmt_execute($stmt);

                    if($result) {
                        echo "Data updated successfully.";
                    } else {
                        echo "Update failed: " . mysqli_error($conn);
                    }
                }
            ?>

        </div>
    </div>
</body>
</html>
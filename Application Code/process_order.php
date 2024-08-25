<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <?php
    //  login info
    $servername = "10.234.2.200"; // who is hosting the sql server
    $username = "otherUser";        // MariaDB username
    $password = "other";      // MariaDB password
    $dbname = "org";          // name of database we are using

    // connect to database
    $conn = new mysqli('localhost', $username, $password, $dbname);


    // check if connection was successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // grab input from previous page
    $product =$conn->real_escape_string($_POST['product']);
    $quantity = (int)$_POST['quantity'];

    //// INSERT TO SALES
    //  prepare statement and send it off
    $stmt = $conn->prepare("INSERT INTO sales (product, quantity) VALUES (?, ?)");
    $stmt->bind_param("si", $product, $quantity); // bind parameters (int and string)

    // execute query
    $stmt->execute();


    //// UPDATE INVENTORY
    // prepare statement and sent it off
    $stmt = $conn->prepare("UPDATE inventory SET quantity = quantity - ? WHERE product = ?");
    $stmt->bind_param("is", $quantity, $product);

   // execute query
   $stmt->execute();


   // closing statement and connection
    $stmt->close();
    $conn->close();


    // create url for selected produce NOTE: THIS WILL ONLY WORK WITH MY BUCKET AND SITE UNLESS YOU CONFIGURE YOURS THE SAME WAY
    $bucketURL = 'https://55-org-marketing1.s3.amazonaws.com/';
    $productURL = $bucketURL . strtolower($product) . '.jpeg';
    ?>

    <h1>Thank you for purchasing <?php echo htmlspecialchars($product); ?>!</h1>
    <img src="<?php echo htmlspecialchars($productURL); ?>" alt="<?php echo htmlspecialchars($product); ?>" width="200">

    <form action="make_order.php" method="POST">
        Enter shipping address: <input type="text" name="shipping_address" required><br><br>

        Enter Credit Card Number: <input type="text" name="cc_number" required><br><br>

        Enter Card Expiration Date: <input type="text" name="cc_expiration" required><br><br>

        Enter Card Security Number: <input type="text" name="cc_security" required><br><br>

        Enter billing address: <input type="text" name="billing_address" required><br><br>


        <input type="submit" value="Submit">
    </form>
</body>
</html>

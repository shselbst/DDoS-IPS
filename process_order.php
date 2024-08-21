<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <?php
    //  login info
    $servername = "10.234.2.200"; // PRIVATE IP OF inventory/sales instance
    $username = "otherUser";
    $password = "other";
    $dbname = "org";

    // login to make connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // check if connection was successful
    if ($conn->connect_error) {
        die("Unable to connect to database");
    }

    // grab data from previous page
    $product =$conn->real_escape_string($_POST['product']);
    $quantity = (int)$_POST['quantity'];

    // insert data into 'sales' table
    $sql = "INSERT INTO sales (product, quantity) VALUES ('$product', $quantity)";
    $conn->query($sql);

    // update inventory by subtracting the quantity from the current inventory of the selected product
    $sql = "UPDATE inventory SET quantity = quantity - $quantity WHERE product = '$product'";
    $conn->query($sql);
    $conn->close();

    // create url for selected produce NOTE: THIS WILL ONLY WORK WITH MY BUCKET AND SITE UNLESS YOU CONFIGURE YOURS THE SAME WAY
    $bucketURL = 'https://55-org-marketing1.s3.amazonaws.com/';
    $productURL = $bucketURL . strtolower($product) . '.jpeg';
    ?>

    <h1>Thank you for purchasing <?php echo htmlspecialchars($product); ?>!</h1>
    <img src="<?php echo htmlspecialchars($productURL); ?>" alt="<?php echo htmlspecialchars($product); ?>" width="200">

    <form action="make_order.php" method="POST">
        <input type="hidden" name="product" value="<?php echo htmlspecialchars($product); ?>">
        <input type="hidden" name="quantity" value="<?php echo htmlspecialchars($quantity); ?>">

        Enter shipping address: <input type="text" name="shipping_address" required><br><br>

        Enter Credit Card Number: <input type="text" name="cc_number" required><br><br>

        Enter Card Expiration Date: <input type="text" name="cc_expiration" required><br><br>

        Enter Card Security Number: <input type="text" name="cc_security" required><br><br>

        Enter billing address: <input type="text" name="billing_address" required><br><br>


        <input type="submit" value="Submit">
    </form>
</body>
</html>

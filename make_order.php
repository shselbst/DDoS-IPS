<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <?php
    // login informaiton
    $servername = "10.234.2.200"; // PRIVATE IP OF inventory/sales instance
    $username = "otherUser";
    $password = "other";
    $dbname = "org";

    // attempt to login
    $conn = new mysqli($servername, $username, $password, $dbname);

    // check if we actually logged into the adatabase
    if ($conn->connect_error) {
        die("Couldn't connect to the database");
    }
    // grab customer data from previous form
    $shipping_address = $conn->real_escape_string($_POST['shipping_address']);
    $cc_number = $conn->real_escape_string($_POST['cc_number']);
    $cc_expiration = $conn->real_escape_string($_POST['cc_expiration']);
    $cc_security = $conn->real_escape_string($_POST['cc_security']);
    $billing_address = $conn->real_escape_string($_POST['billing_address']);

    // insert customer info into database on internal instance
    $sql = "INSERT INTO orders (shipping_address, cc_number, cc_expiration, cc_security, billing_address)
            VALUES ('$shipping_address', '$cc_number', '$cc_expiration', '$cc_security', '$billing_address')";

// execute statement and close connection
    $conn->query($sql);
    $conn->close();
    ?>

    <h1>Thank you for your purchase! You will receive a package at <?php echo htmlspecialchars($shipping_address); ?> shortly! </h1>
</body>
</html>

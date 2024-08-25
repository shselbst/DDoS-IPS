<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <h1>Thank You!</h1>
    <p>Your help ticket has been submitted.</p>

    <?php



    // Database connection info
    $servername = 'localhost'; // who is hosting the sql server
    $username = "otherUser";        // MariaDB username
    $password = "other";      // MariaDB password
    $dbname = "org";          // name of database we are using

    // connect to database
    $conn = new mysqli('localhost', $username, $password, $dbname);


        // if they sent a post request (used the form)
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // grab email and described issue
        $email = $_POST['email'];
        $issue = $_POST['issue'];

        // let the customer know we will get back to them
        echo "<p>A customer service agent will reach out to you at $email soon</p>";

        # add information to database
        $sql = "INSERT INTO help_tickets (email, issue) VALUES ('$email', '$issue')";
        $conn->query($sql);

    } else {
    echo "<p>Request method is not POST.</p>";
}

    // close connection to database
    $conn->close();
    ?>

    <p><a href="customer_service.php">Submit another ticket</a></p>
    <p><a href="index.html">Back to Home</a></p>
</body>
</html>








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
        $email = htmlspecialchars($_POST['email']);
        $issue = htmlspecialchars($_POST['issue']);
        echo "<p>A customer service agent will reach out to you at $email soon</p>";

        $sql2 = "SELECT issue FROM help_tickets";
        $result = $conn->query($sql2);


        // using prepared statements
        $stmt = $conn->prepare("INSERT INTO help_tickets (email, issue) VALUES (?, ?)");

        // bind both paramters as strings
        $stmt->bind_param("ss", $email, $issue);

        // execute stateement and close it, will close connection later
        $stmt->execute();
        $stmt->close();


    } else {
            echo "<p>Request method is not POST.</p>";
        }
    // display previously submitted requests
    $request = "SELECT issue FROM help_tickets";
    $result = $conn->query($request);

     echo "Recently Submitted Issues: <br />";
     while ($row = $result->fetch_assoc()){ // repeatedly grab next row until row has no value
           echo "<br />".htmlspecialchars($row['issue'])."<br />";
     }
 // close connection
    $conn->close();
    ?>

    <p><a href="customer_service.php">Submit another ticket</a></p>
    <p><a href="index.html">Back to Home</a></p>
</body>
</html>

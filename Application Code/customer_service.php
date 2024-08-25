<!DOCTYPE html>
<html>
<head>
    <img src="https://55-org-marketing1.s3.amazonaws.com/telescopelogo.jpg" style="width:800px">
</head>
<body>
    <h1>Customer Service Page</h1>
    <p>Hello! If you are experiencing technical difficulties, have questions about a product, or have any other related troubles or complaints, please call this number: <strong>123-456-7890</strong> or submit a help ticket below:>
    <h2>Help Ticket</h2>
    <form action="submit_ticket.php" method="post">
        <p>
            <label for="email">Email address:</label><br>
            <input type="text" id="email" name="email" required>
        </p>
        <p>
            <label for="issue">Describe the issue here:</label><br>
            <textarea id="issue" name="issue" rows="5" cols="50" required></textarea>
        </p>
        <p>
            <input type="submit" value="Submit">
        </p>
    </form>
</body>
</html>

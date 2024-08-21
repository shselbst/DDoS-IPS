<!DOCTYPE html>
<head>
</head>
<body>
    <h1>Welcome to Telescope Online Retailer! See our wonderful products!</h1>

    <h2>Telescope1</h2>
    <img src="https://55-org-marketing1.s3.amazonaws.com/telescope1.jpeg" alt="Telescope1">

    <h2>Telescope2</h2>
    <img src="https://55-org-marketing1.s3.amazonaws.com/telescope2.jpeg" alt="Telescope2">

    <h2>Telescope3</h2>
    <img src="https://55-org-marketing1.s3.amazonaws.com/telescope3.jpeg" alt="Telescope3">


    <form action="process_order.php" method="POST">
        Which product would you like?
        <select name="product" required>
            <option value="Telescope1">Telescope1</option>
            <option value="Telescope2">Telescope2</option>
            <option value="Telescope3">Telescope3</option>
        </select>
        <br><br>
        How many would you like? <input type="number" name="quantity" required min="1"><br><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>

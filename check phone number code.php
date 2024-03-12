<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "earns_limited";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$phoneNumberInfo = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get phone number from the form
    $phoneNumberToRetrieve = $_POST["phoneNumberToRetrieve"];

    // Retrieve information from the database
    $sqlRetrieve = "SELECT * FROM earns_limited WHERE phone_number = '$phoneNumberToRetrieve'";
    $result = $conn->query($sqlRetrieve);

    if ($result->num_rows > 0) {
        // Fetch data from the result set
        $row = $result->fetch_assoc();
        $phoneNumberInfo = $row;
    } else {
        $phoneNumberInfo = 'No information found for the entered phone number.';
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phone Number Information Retrieval</title>
    <link rel="stylesheet" href="style for swany mwas.css">
</head>
<body>

<!-- Header -->
<header>
<h1>Click on your preffered action</h1>
    <nav>  
    <a href="code to generate unique code.php">Generate-code</a>
    <a href="check phone number code.php">Check-code</a>
            </nav>
           
</header>
<h1 class="message">Phone Number Information</h1>
<!-- Main Content -->
<div class="container">
    <h2>Retrieve Information by Phone Number</h2>
    <form method="post" action="">
        <label for="phoneNumberToRetrieve">Enter Phone Number To Check Code:</label>
        <input type="tel" id="phoneNumberToRetrieve" name="phoneNumberToRetrieve" placeholder="Enter phone number" required>
        <button type="submit">Retrieve Information</button>
    </form>

    <!-- Display retrieved information -->
    <?php if (is_array($phoneNumberInfo)) : ?>
        <div class="info-message">
            <h3>Information for Phone Number: <?php echo $phoneNumberInfo['phone_number']; ?></h3>
            <p>Username: <?php echo $phoneNumberInfo['users']; ?></p>
            <p>Code: <?php echo $phoneNumberInfo['code']; ?></p>
        </div>
    <?php else : ?>
        <div class="info-message"><?php echo $phoneNumberInfo; ?></div>
    <?php endif; ?>
</div>

</body>
</html>


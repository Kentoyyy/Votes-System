<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Database connection details
    $host = "localhost";  // Database host (usually localhost)
    $dbuser = "root";  // Your database username
    $dbpass = "";  // Your database password
    $dbname = "db_voting";     // Your database name

    // Create a database connection
    $conn = new mysqli($host, $dbuser, $dbpass, $dbname);

    // Check for a connection error
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute a query to check user credentials
    $query = "SELECT * FROM users WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a row is returned
    if ($result->num_rows === 1) {
        // Authentication successful
        echo "Login successful. Welcome, $email!";
    } else {
        // Authentication failed
        echo "Login failed. Please check your username and password.";
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
?>

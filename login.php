<?php
session_start(); // Start the session at the beginning of the script

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Database connection details
    $host = "localhost";  // Database host (usually localhost)
    $dbuser = "root";      // Your database username
    $dbpass = "";          // Your database password
    $dbname = "votes";     // Your database name

    // Create a database connection
    $conn = new mysqli($host, $dbuser, $dbpass, $dbname);

    // Check for a connection error
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute a query to check user credentials
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a row is returned
    if ($result->num_rows === 1) {
        // Fetch the stored hashed password
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Authentication successful
            echo "Login successful. Welcome, $email!";

            // Store the email in the session
            $_SESSION["email"] = $email;

            // Redirect to the index2.html page
            header("Location: index2.php");
            exit();
        } else {
            // Authentication failed
            echo "Login failed. Please check your username and password.";
        }
    } else {
        // Authentication failed (user not found)
        echo "Login failed. Please check your username and password.";
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
?>

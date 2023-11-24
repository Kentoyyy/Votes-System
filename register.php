<?php
// Define database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "votes";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define variables to store user input
$firstname = $lastname = $contact = $address = $email = $password = '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    // Check if the two password fields match
    if ($password != $password2) {
        echo "Error: Passwords do not match";
        exit();
    }

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if the email already exists in the database
    $sql = "SELECT * FROM users WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Error: Email already exists";
        exit();
    }

    // Insert data into the database using prepared statements
    $sql = "INSERT INTO users (firstname, lastname, contact, address, email, password) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $firstname, $lastname, $contact, $address, $email, $hashed_password);

    if ($stmt->execute()) {
        // Registration successful
        echo '<h2>Registration Successful</h2>';
        echo '<p>Firstname: ' . $firstname . '</p>';
        echo '<p>Lastname: ' . $lastname . '</p>';
        echo '<p>Contact: ' . $contact . '</p>';
        echo '<p>Address: ' . $address . '</p>';
        echo '<p>Email: ' . $email . '</p>';

        sleep(2);

        header("Location: login.html");
        exit();
    } else {
        // Registration failed
        echo '<p>Error: ' . $stmt->error . '</p>';
    }

    // Close the statements
    $stmt->close();
}

// Close the database connection
$conn->close();
?>

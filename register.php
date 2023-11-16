<?php
// Define database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_voting";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define variables to store user input
$firstname = $lastname = $contact = $address = $email = $password = '';

// Define variables to store error messages
$firstnameErr = $lastnameErr = $contactErr = $addressErr = $emailErr = $passwordErr = '';

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

    // Check if the email already exists in the database
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      echo "Error: Email already exists";
      exit();
    }

    // If there are no errors, insert data into the database
    if (empty($firstnameErr) && empty($lastnameErr) && empty($contactErr) && empty($addressErr) && empty($emailErr) && empty($passwordErr) && empty($password2Err)) {
        // Hash the password for security

        // Prepare and execute the SQL query to insert data
        $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, contact, address, email, password) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $firstname, $lastname, $contact, $address, $email, $password);

        if ($stmt->execute()) {
            // Registration successful
            echo '<h2>Registration Successful</h2>';
            echo '<p>Firstname: ' . $firstname . '</p>';
            echo '<p>Lastname: ' . $lastname . '</p>';
            echo '<p>Contact: ' . $contact . '</p>';
            echo '<p>Address: ' . $address . '</p>';
            echo '<p>Email: ' . $email . '</p>';
        } else {
            // Registration failed
            echo '<p>Error: ' . $stmt->error . '</p>';
        }

        // Close the statement
        $stmt->close();
    }
}

// Close the database connection
$conn->close();
?>

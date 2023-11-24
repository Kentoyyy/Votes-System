<?php
session_start(); // Start the session at the beginning of the script

// Check if the user is not logged in, redirect to the login page
if (!isset($_SESSION["email"])) {
    header("Location: login.html");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "votes";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the candidate ID from the form
if (isset($_POST['candidate_id'])) {
    $candidate_id = $_POST['candidate_id'];

    // Get the user email from the session
    $user_email = $_SESSION["email"];

    // Check if the user has already voted for this candidate
    $checkVoteQuery = "SELECT * FROM votes WHERE user_email = '$user_email' AND candidate_id = '$candidate_id'";
    $checkVoteResult = $conn->query($checkVoteQuery);

    if ($checkVoteResult->num_rows > 0) {
        // User has already voted for this candidate
        echo "You have already voted for this candidate.";
    } else {
        // Insert the vote into the votes table
        $insertVoteQuery = "INSERT INTO votes (user_email, candidate_id) VALUES ('$user_email', '$candidate_id')";
        if ($conn->query($insertVoteQuery) === TRUE) {
            echo "Vote successfully counted!";
        } else {
            echo "Error: " . $insertVoteQuery . "<br>" . $conn->error;
        }
    }
} else {
    echo "Invalid request. Candidate ID not provided.";
}

$conn->close();
?>

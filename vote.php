<?php
session_start();

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
    $checkVoteQuery = "SELECT * FROM user_votes WHERE user_id IN (SELECT id FROM users WHERE email = '$user_email') AND candidate_id = '$candidate_id'";
    $checkVoteResult = $conn->query($checkVoteQuery);

    if ($checkVoteResult->num_rows > 0) {
        // User has already voted for this candidate
        echo "You have already voted for this candidate.";
    } else {
        // Get the user ID
        $getUserIDQuery = "SELECT id FROM users WHERE email = '$user_email'";
        $userIDResult = $conn->query($getUserIDQuery);

        if ($userIDResult->num_rows > 0) {
            $row = $userIDResult->fetch_assoc();
            $user_id = $row['id'];

            // Insert the vote into the user_votes table
            $insertVoteQuery = "INSERT INTO user_votes (user_id, candidate_id) VALUES ('$user_id', '$candidate_id')";
            if ($conn->query($insertVoteQuery) === TRUE) {
                echo "Vote successfully counted!";
            } else {
                echo "Error: " . $insertVoteQuery . "<br>" . $conn->error;
            }
        } else {
            echo "Error getting user ID.";
        }
    }
} else {
    echo "Invalid request. Candidate ID not provided.";
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Votes</title>
    <link rel="stylesheet" href="DashVoting.css">
</head>

<body>
    <a href="votes.php" class="nav__link">Back</a>
</body>

</html>

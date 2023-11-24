<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "votes";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Count participants who have voted
$sqlParticipants = "SELECT COUNT(*) as count FROM users WHERE has_voted = 1";
$resultParticipants = $conn->query($sqlParticipants);

if ($resultParticipants) {
    $rowParticipants = $resultParticipants->fetch_assoc();
    $participantCount = $rowParticipants['count'];
} else {
    echo "Error counting participants: " . $conn->error;
}

// Count total accounts
$sqlAccounts = "SELECT COUNT(*) as count FROM users";
$resultAccounts = $conn->query($sqlAccounts);

if ($resultAccounts) {
    $rowAccounts = $resultAccounts->fetch_assoc();
    $accountCount = $rowAccounts['count'];
} else {
    echo "Error counting accounts: " . $conn->error;
}

// Count total casted votes
$sqlCastedVotes = "SELECT COUNT(*) as count FROM votes"; // Assuming you have a 'votes' table
$resultCastedVotes = $conn->query($sqlCastedVotes);

if ($resultCastedVotes) {
    $rowCastedVotes = $resultCastedVotes->fetch_assoc();
    $castedVotesCount = $rowCastedVotes['count'];
} else {
    echo "Error counting casted votes: " . $conn->error;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Votes</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
</head>
<body>
    <div class="sidebar">
        <div class="logo"></div>
        <ul class="menu">
            <li class="active">
                <a href="#">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-bullhorn"></i>
                    <span>Announce</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-user"></i>
                    <span>Profile</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-check"></i>
                    <span>Voters</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-registered"></i>
                    <span>Registered</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </a>
            </li>
            <li class="logout">
                <a href="#">
                    <i class="fas fa-sign-out"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="main-content">
        <div class="header-wrapper">
            <div class="header-title">
                <span>Overview</span>
                <h2>Dashboard</h2>
            </div>
            <div class="user-info">
                <div class="search-box">
                    <i class="fa-solid fa-search"></i>
                    <input type="text" placeholder="Search"/>
                </div>
                <img src="assets/img/person_profile.png" alt=""/>
            </div>
        </div>

        <div class="container">
        <div class="card-participation">
            <i class="fa-solid fa-check-circle"></i>
            <h2>Participations</h2>
            <h3><?php echo $participantCount; ?></h3>
        </div>

        <div class="card-accounts">
            <i class="fa-solid fa-user-circle"></i>
            <h2>Accounts</h2>
            <h3><?php echo $accountCount; ?></h3>
        </div>

        <div class="card-votes">
            <i class="fa-solid fa-check-circle"></i>
            <h2>Casted Votes</h2>
            <h3><?php echo $castedVotesCount; ?></h3>
        </div>

        <div class="card-voters-email">
            <i class="fa-solid fa-envelope"></i>
            <h2>Voters' Emails</h2>
            <?php
            if (!empty($votedUsers)) {
                echo "<ul>";
                foreach ($votedUsers as $votedUser) {
                    echo "<li>$votedUser</li>";
                }
                echo "</ul>";
            } else {
                echo "<p>No votes casted yet.</p>";
            }
            ?>
        </div>
    </div>
   
    
</body>
</html>
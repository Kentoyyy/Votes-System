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
$sqlParticipants = "SELECT COUNT(DISTINCT user_id) as count FROM user_votes";
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
$sqlCastedVotes = "SELECT COUNT(*) as count FROM user_votes";
$resultCastedVotes = $conn->query($sqlCastedVotes);

if ($resultCastedVotes) {
    $rowCastedVotes = $resultCastedVotes->fetch_assoc();
    $castedVotesCount = $rowCastedVotes['count'];
} else {
    echo "Error counting casted votes: " . $conn->error;
}

// Fetch voters who have cast their votes along with the candidates they voted for
$sqlVotedUsers = "SELECT DISTINCT users.email, GROUP_CONCAT(candidates.name) as voted_candidates
                  FROM users
                  INNER JOIN user_votes ON users.id = user_votes.user_id
                  INNER JOIN candidates ON user_votes.candidate_id = candidates.id
                  GROUP BY users.email";
$resultVotedUsers = $conn->query($sqlVotedUsers);

if ($resultVotedUsers) {
    $votedUsers = [];
    while ($rowVotedUsers = $resultVotedUsers->fetch_assoc()) {
        $votedUsers[] = $rowVotedUsers; // Store the entire row
    }
} else {
    echo "Error fetching voted users: " . $conn->error;
}


$conn->close();
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
                <a href="Candidates.php">
                    <i class="fas fa-check"></i>
                    <span>Candidates</span>
                </a>
            </li>
            <li>
                <a href="Registered.php">
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
                echo "<li>{$votedUser['email']} voted for: {$votedUser['voted_candidates']}</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No votes casted yet.</p>";
        }
        ?>
    </div>
    
</body>
</html>
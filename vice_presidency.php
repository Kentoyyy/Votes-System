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

// Fetch candidates running for Vice Presidency with their votes from the database
$sql = "SELECT candidates.id, candidates.name, candidates.position, 
               COUNT(user_votes.candidate_id) AS voted 
        FROM candidates 
        LEFT JOIN user_votes ON candidates.id = user_votes.candidate_id 
        WHERE candidates.position = 'Vice-President'
        GROUP BY candidates.id, candidates.name, candidates.position";
$result = $conn->query($sql);

// Initialize candidates array
$candidates = [];

// Check if the query was successful
if ($result) {
    // Fetch candidates and store them in the array
    while ($row = $result->fetch_assoc()) {
        $candidates[] = $row;
    }
} else {
    echo "Error fetching candidates: " . $conn->error;
}
// Function to fetch and display counts
function displayCounts() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "votes";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Count positions
    $sqlPositions = "SELECT COUNT(DISTINCT position) as count FROM candidates";
    $resultPositions = $conn->query($sqlPositions);
    $positionCount = ($resultPositions && $resultPositions->num_rows > 0) ? $resultPositions->fetch_assoc()['count'] : 0;

    // Count candidates
    $sqlCandidates = "SELECT COUNT(*) as count FROM candidates";
    $resultCandidates = $conn->query($sqlCandidates);
    $candidateCount = ($resultCandidates && $resultCandidates->num_rows > 0) ? $resultCandidates->fetch_assoc()['count'] : 0;

    // Count voters who have voted
    $sqlVotersVoted = "SELECT COUNT(DISTINCT user_id) as count FROM user_votes";
    $resultVotersVoted = $conn->query($sqlVotersVoted);
    $votersVotedCount = ($resultVotersVoted && $resultVotersVoted->num_rows > 0) ? $resultVotersVoted->fetch_assoc()['count'] : 0;

    // Count total voters
    $sqlTotalVoters = "SELECT COUNT(*) as count FROM users";
    $resultTotalVoters = $conn->query($sqlTotalVoters);
    $totalVotersCount = ($resultTotalVoters && $resultTotalVoters->num_rows > 0) ? $resultTotalVoters->fetch_assoc()['count'] : 0;

    // Display counts in containers
    echo "<div class='position-container'>
            <h2 class='number'>$positionCount</h2>
            <p>No. of positions</p>
        </div>";

    echo "<div class='candidates-container'>
            <h2 class='number'>$candidateCount</h2>
            <p>No. of Candidates</p>
        </div>";

    echo "<div class='votersvoid-container'>
            <h2 class='number'>$votersVotedCount</h2>
            <p>Voters-voted</p>
        </div>";

    echo "<div class='totalvoters-container'>
            <h2 class='number'>$totalVotersCount</h2>
            <p>Total Voters</p>
        </div>";

    $conn->close();  // Close the connection
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
    <header>
        <img class="logo" src="assets/img/votes logo.png" alt="logo">

        <nav>
            <ul class="nav_links">
                <li><a href="index2.php">Home</a></li>
                <li><a href="index2.php">Vote</a></li>
                <li><a href="index2.php">Candidates</a></li>
                <li><a href="Dashboard_Voting.php">Election Result</a></li>
                <li><a href="index2.php">FAQs & Help</a></li>
            </ul>
        </nav>
    </header>

    <div class="container-positions">
    <?php
        // Call the function to display counts
        displayCounts();
        ?>
    </div>
    <!-- Your position-container, candidates-container, votersvoid-container, totalvoters-container, and dashboard elements go here -->

    <h2 class="dashboard">DASHBOARD</h2>
    <div class="left-container">
            <h2>Cast your Votes, Now!</h2>
            <div class="line"></div>
            <p>All your votes will be directed to tally votes. Thank you!</p>

            <table>
                <thead>
                    <tr style="color: #000; position: absolute; margin-top: 75px; margin-left: 40px; font-size: 14px;">
                        <th>Rank</th>
                        <th style="padding-left: 110px; padding-right: 145px;">Candidates</th>
                        <th>Vote</th>
                    </tr>
                </thead>

                <div class="candidates">
                    <table style="margin-top: 100px;">
                        <tbody>
                            <?php
                            // Your PHP code for fetching and displaying candidates here
                            if (!empty($candidates)) {
                                $rank = 1;
                                foreach ($candidates as $row) {
                                    echo "<tr>";
                                    echo "<td>" . $rank . "</td>";
                                    echo "<td>" . $row["name"] . "</td>";
                                    echo "<td><form method='post' action='vote.php'>
                                            <input type='hidden' name='candidate_id' value='" . $row["id"] . "'>
                                            <button type='submit' class='vote-button'>Vote</button>
                                        </form></td>";
                                    echo "</tr>";
                                    $rank++;
                                }
                            } else {
                                echo "<tr><td colspan='3'>No candidates available</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </table>
        </div>

    <div class="right-container">
        <h2>Vice Presidential Race!</h2>
        <div class="line"></div>
        <p>Here’s the candidates for running in Vice President position!</p>
        <table>
            <thead>
                <tr style="color: #000; position: absolute; margin-top: 80px; margin-left: 40px; font-size: 14px;">
                    <th>Rank</th>
                    <th style="padding-left: 50px; padding-right: 140px;">Candidates</th>
                    <th>Percent</th>
                </tr>
            </thead>
            <div class="progress-candidates">
                <table style="margin-top: 120px;">
                    <tbody>
                        <?php
                        // Check if candidates array is not empty
                        if (!empty($candidates)) {
                            $rank = 1;
                            foreach ($candidates as $row) {
                                echo "<tr>";
                                echo "<td>" . $rank . "</td>";
                                echo "<td>" . $row["name"] . "</td>";

                                // Calculate percentage dynamically
                                $totalVotes = $row['voted'];
                                $totalVotesAll = array_sum(array_column($candidates, 'voted'));
                                $percentage = ($totalVotesAll > 0) ? round(($totalVotes / $totalVotesAll) * 100, 2) : 0;

                                echo "<td><progress value='$percentage' max='100'></progress> $percentage%</td>";
                                echo "</tr>";
                                $rank++;
                            }
                        } else {
                            echo "<tr><td colspan='3'>No candidates available</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <button class="view-button" onclick="window.location.href='secretary.php'">View Secretary</button>
    <button class="view-button" onclick="window.location.href='votes.php'">View Presidency</button>
    <button class="view-button" onclick="window.location.href='treasurer.php'">View treasurer</button>
</body>

</html>

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

// Fetch candidates with their votes from the database
$sql = "SELECT id, name, position, voted FROM candidates";
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

    <div clas="container-positions">

        <div class="position-container">
            <h2 class="number">00</h2>
            <p>No. of positions</p>

        </div>

        <div class="candidates-container">
            <h2 class="number">00</h2>
            <p>No. of Candidates</p>

        </div>

        <div class="votersvoid-container">
            <h2 class="number">00</h2>
            <p>Voters-voted</p>

        </div>

        <div class="totalvoters-container">
            <h2 class="number">00</h2>
            <p>Total Voters</p>

        </div>

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
            <h2>Presidential Race!</h2>
            <div class="line"></div>
            <p>Here’s the candidates for running in President position!</p>
                <table >
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
                            $totalVotes = $row['voted'];
                            // Calculate percentage
                            $percentage = ($totalVotes > 0) ? round(($totalVotes / $totalVotes) * 100, 2) : 0;

                            echo "<tr>";
                            echo "<td>" . $rank . "</td>";
                            echo "<td>" . $row["name"] . "</td>";
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
</body>

</html>

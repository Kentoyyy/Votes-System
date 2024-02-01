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

// Function to remove a candidate
function removeCandidate($conn, $candidateId) {
    $sqlRemoveCandidate = "DELETE FROM candidates WHERE id = $candidateId";
    if ($conn->query($sqlRemoveCandidate) === TRUE) {
        echo "<script>alert('Candidate removed successfully');</script>";
        header("Location: candidates.php"); // Redirect back to candidates.php
        exit();
    } else {
        echo "Error removing candidate: " . $conn->error;
    }
}

// Check if the remove candidate button is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["removeCandidate"])) {
    $candidateId = $_POST["candidateId"];
    removeCandidate($conn, $candidateId);
}

// Fetch candidates and their vote counts
$sqlCandidates = "SELECT candidates.*, COUNT(user_votes.id) as voteCount 
                  FROM candidates 
                  LEFT JOIN user_votes ON candidates.id = user_votes.candidate_id 
                  GROUP BY candidates.id";
$resultCandidates = $conn->query($sqlCandidates);

if ($resultCandidates) {
    $candidates = [];
    while ($rowCandidates = $resultCandidates->fetch_assoc()) {
        $candidates[] = $rowCandidates;
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
    <title>Admin - Candidates</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            box-sizing: border-box;
        }

        .add-candidate-button {
            float: right;
            margin-right: 20px;
        }

        .remove-candidate-button {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
        }

        /* Style for the vote count */
        .vote-count {
            margin-left: 10px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo"></div>
        <ul class="menu">
            <li>
                <a href="admin.php">
                    <i class="fas fa-checkfas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="active">
                <a href="candidates.php">
                    <i class="fas fa-check"></i>
                    <span>Candidates</span>
                </a>
            </li>
            <li>
                <a href="Registered.php">
                    <i class="fas fa-tachometer-alt"></i>
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
                <h2>Candidates</h2>
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
            <!-- Display existing candidates -->
            <div class="card-candidates">
                <i class="fa-solid fa-user-circle"></i>
                <h2>Candidates</h2>
                <?php
                if (!empty($candidates)) {
                    echo "<ul>";
                    foreach ($candidates as $candidate) {
                        echo "<li>{$candidate['name']} - {$candidate['position']} ";
                        echo "<span class='vote-count'>Votes: {$candidate['voteCount']}</span>";
                        echo "<form method='post' action='{$_SERVER["PHP_SELF"]}' style='display:inline;'>";
                        echo "<input type='hidden' name='candidateId' value='{$candidate['id']}'>";
                        echo "<button type='submit' class='remove-candidate-button' name='removeCandidate'>Remove</button>";
                        echo "</form></li>";
                    }
                    echo "</ul>";
                } else {
                    echo "<p>No candidates available.</p>";
                }
                ?>
            </div>

            <!-- Add Candidate button -->
            <a href="add_candidate.php" class="add-candidate-button">Add Candidate</a>
        </div>
    </div>
</body>
</html>

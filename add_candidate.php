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

// Check if the add candidate form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["addCandidate"])) {
    $candidateName = $_POST["candidateName"];
    $candidatePosition = $_POST["candidatePosition"];

    // Insert new candidate into the database
    $sqlInsertCandidate = "INSERT INTO candidates (name, position) VALUES ('$candidateName', '$candidatePosition')";
    if ($conn->query($sqlInsertCandidate) === TRUE) {
        echo "<script>alert('Candidate added successfully');</script>";
        header("Location: candidates.php"); // Redirect back to candidates.php
        exit();
    } else {
        echo "Error adding candidate: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Add Candidate</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <div class="sidebar">
        <div class="logo"></div>
        <ul class="menu">
            <li class="active">
                <a href="admin.php">
                    <i class="fas fa-checkfas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
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
                <h2>Add Candidate</h2>
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
            <!-- Form for adding candidates -->
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <label for="candidateName">Candidate Name:</label>
                <input type="text" id="candidateName" name="candidateName" required>

                <label for="candidatePosition">Candidate Position:</label>
                <input type="text" id="candidatePosition" name="candidatePosition" required>

                <button type="submit" name="addCandidate">Add Candidate</button>
            </form>
        </div>
    </div>
</body>
</html>

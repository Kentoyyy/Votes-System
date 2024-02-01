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

// Fetch all registered accounts
$sqlRegisteredAccounts = "SELECT * FROM users";
$resultRegisteredAccounts = $conn->query($sqlRegisteredAccounts);

if ($resultRegisteredAccounts) {
    $registeredAccounts = [];
    while ($rowRegisteredAccounts = $resultRegisteredAccounts->fetch_assoc()) {
        $registeredAccounts[] = $rowRegisteredAccounts;
    }
} else {
    echo "Error fetching registered accounts: " . $conn->error;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Registered</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
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
            <li>
                <a href="Candidates.php">
                    <i class="fas fa-check"></i>
                    <span>Candidates</span>
                </a>
            </li>
            <li class="active">
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
                <h2>Registered Accounts</h2>
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
            <div class="card-registered-accounts">
                <i class="fa-solid fa-user-circle"></i>
                <h2>Registered Accounts</h2>
                <?php
                if (!empty($registeredAccounts)) {
                    echo "<ul>";
                    foreach ($registeredAccounts as $account) {
                        echo "<li>{$account['firstname']} {$account['lastname']} - {$account['email']}</li>";
                    }
                    echo "</ul>";
                } else {
                    echo "<p>No registered accounts yet.</p>";
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>

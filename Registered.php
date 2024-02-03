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

    <style>

        .registered-accounts {
            list-style-type: none;
            padding: 0;
        }

        .account-item {
            margin-bottom: 10px;
        }

        .no-accounts {
            color: red;
            font-style: italic;
        }

    </style>
</head>
<body>
<div class="sidebar">
<div class="logo"><img src="votess_logo.png" style="width: 170px; height: 130px; position: absolute; margin-left: -25px; margin-top: -40px;" ></div>
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
        <div class="card-registered-accounts" style="background-color: #fff; width: 900px; height: 400px; padding: 100px 30px 30px;   border-radius: 15px; position: absolute;    font-size: 17px;">
       
        <h2 style=" color: #289965; margin-top: -80px;  font-size: 22px; position: absolute;">Registered Accounts</h2>
        <div class="names">
            <h2 style="position: absolute; margin-top: -30px; font-size: 15px; color: #289965;  font-weight: 600;">Names</h2>
            <h2 style="position: absolute; margin-top: -30px; margin-left: 150px; font-size: 15px; color: #289965;  font-weight: 600;">Email</h2>
        </div>
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

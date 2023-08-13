<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login/login.php');
    exit;
}

$servername = "localhost";
$username = "root";
$password = "12345";
$dbname = "chrive";
$uname = $_SESSION['username'];
$user_id = $_SESSION['user_id'];
$conn = new mysqli($servername, $username, $password, $dbname);
$stmt = $conn->prepare("SELECT * FROM user WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Profile Page</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../reset.css">
    <link rel="stylesheet" href="profile.css">
</head>

<body>
    <nav class="navbar">
        <ul class="nav-links">
            <li>
                <a href="../new-trip/newTrip.php">New Trip</a>
            </li>
        </ul>
        <ul class="nav-links right-link">
            <li>
                <a href="../trip-history/tripsHistory.php">History</a>
            </li>
        </ul>
        <ul class="nav-links right-link">
            <li>
                <a href="../logout/logout.php">Logout</a>
            </li>
        </ul>
    </nav>
    <div class="background-container"></div>
    <div class="profile-card">
        <div class="profile-body">
            <div class="user-info">
                <p class="user-info-header">User Profile</p>
                <table class="info-table">
                    <tr>
                        <td class="info-label">Name:</td>
                        <td class="info-value">
                            <?php echo htmlspecialchars($row['name']); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="info-label">Username:</td>
                        <td class="info-value">
                            <?php echo htmlspecialchars($row['username']); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="info-label">Email:</td>
                        <td class="info-value">
                            <?php echo htmlspecialchars($row['email']); ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    </div>
</body>

</html>
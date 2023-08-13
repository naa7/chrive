<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "12345";
$dbname = "chrive";
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM trips_history WHERE user_id=?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Trip History</title>
    <link rel="stylesheet" type="text/css" href="../reset.css">
    <link rel="stylesheet" href="tripHistory.css">

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
                <a href="../profile/profile.php">Profile</a>
            </li>
        </ul>
        <ul class="nav-links right-link">
            <li>
                <a href="../logout/logout.php">Logout</a>
            </li>
        </ul>
    </nav>
    <div class="background-container"></div>
    <h2>Trip History</h2>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th class="top-left">ID</th>
                    <th>Pickup Address</th>
                    <th>Dropoff Adress</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Passengers</th>
                    <th class="top-right">Phone</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $counter = 1;
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $counter . "</td>";
                        echo "<td>" . $row["pickup_location"] . "</td>";
                        echo "<td>" . $row["dropoff_location"] . "</td>";
                        echo "<td>" . $row["trip_date"] . "</td>";
                        echo "<td>" . $row["trip_time"] . "</td>";
                        echo "<td>" . $row["passengers"] . "</td>";
                        echo "<td>" . $row["phone"] . "</td>";
                        echo "</tr>";
                        $counter++;
                    }
                } else {
                    echo "<tr><td colspan='7' style='text-align: center; padding: 10px; font-size: 1.25rem;'>No trips found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>

<?php
mysqli_stmt_close($stmt);
$conn->close();
?>
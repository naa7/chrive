<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login/login.php');
    exit;
}

$envFilePath = __DIR__ . '/../.env';

if (file_exists($envFilePath)) {
    $envVariables = parse_ini_file($envFilePath);
    $servername = $envVariables['DB_HOST'];
    $username = $envVariables['DB_USERNAME'];
    $password = $envVariables['DB_PASSWORD'];
    $dbname = $envVariables['DB_NAME'];
} else {
    die('.env file not found');
}

$message = "";
$user_id = $_SESSION['user_id'];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("UPDATE user SET name = ?, username = ?, email = ? WHERE id = ?");
    $stmt->bind_param("sssi", $name, $username, $email, $user_id);

    if ($stmt->execute()) {
        $_SESSION['username'] = $username;
    }

    $stmt->close();

    if (!empty($_POST['new_password']) && $_POST['new_password'] === $_POST['confirm_password']) {
        $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
        $update_password_stmt = $conn->prepare("UPDATE user SET password = ? WHERE id = ?");
        $update_password_stmt->bind_param("si", $new_password, $user_id);
        $update_password_stmt->execute();
        $update_password_stmt->close();
    } else {
        $message = "Passwords do not match";
    }
}

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
                <form action="" method="post">
                    <table class="info-table">
                        <tr>
                            <td class="info-label">Name:</td>
                            <td class="info-value">
                                <?php if (!isset($_POST['edit'])): ?>
                                    <span>
                                        <?php echo htmlspecialchars($row['name']); ?>
                                    </span>
                                <?php else: ?>
                                    <input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>">
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="info-label">Username:</td>
                            <td class="info-value">
                                <?php if (!isset($_POST['edit'])): ?>
                                    <span>
                                        <?php echo htmlspecialchars($row['username']); ?>
                                    </span>
                                <?php else: ?>
                                    <input type="text" name="username"
                                        value="<?php echo htmlspecialchars($row['username']); ?>">
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="info-label">Email:</td>
                            <td class="info-value">
                                <?php if (!isset($_POST['edit'])): ?>
                                    <span>
                                        <?php echo htmlspecialchars($row['email']); ?>
                                    </span>
                                <?php else: ?>
                                    <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>">
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <?php if (isset($_POST['edit'])): ?>
                                <td class="info-label">Password:</td>
                                <td class="info-value">
                                    <input type="password" name="new_password" placeholder="New Password">
                                    <input type="password" name="confirm_password" placeholder="Confirm Password">
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>
                    <p class="login-error">
                        <?php echo $message; ?>
                    </p>
                    <?php if (!isset($_POST['edit'])): ?>
                        <button type="submit" name="edit">Edit</button>
                    <?php else: ?>
                        <button type="submit" name="save">Save</button>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
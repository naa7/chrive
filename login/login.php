<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
$servername = "localhost";
$username = "root";
$password = "12345";
$dbname = "chrive";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (!empty($_POST['username']) && !empty($_POST['password'])) {
    $uname = $_POST['username'];
    $pswrd = $_POST['password'];

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT id, password FROM user WHERE username = ?");
    $stmt->bind_param("s", $uname);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
      $row = $result->fetch_assoc();
      $storedPassword = $row['password'];
      if (password_verify($pswrd, $storedPassword)) {
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $uname;

        header('Location: ../profile/profile.php');
        exit;
      } else {
        $message = "Authentication failed. Invalid email/username or password";
      }
    } else {
      $message = "Please enter a valid email/username and password";
    }

    $stmt->close();
    $conn->close();
  } else {
    $message = "Please enter a valid email/username and password";
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Login Page</title>
  <meta name="description" content="" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="../reset.css">
  <link rel="stylesheet" href="login.css" />
  <link rel="stylesheet" href="../navbar/navbar.css" />

</head>

<body>
  <nav class="navbar">
    <ul class="nav-links">
      <li>
        <div class="logo-container">
          <a href="../index.php"><img src="../assets/logo.png" alt="Logo"></a>
        </div>
      </li>
    </ul>
  </nav>
  <div class="login-container">
    <div class="login-message">LOG IN</div>
    <div class="login-body">
      <div class="login-top"></div>
      <div class="login-bottom"></div>
      <div class="login-center">
        <p class="login-header">Sign in to Chrive</p>
        <form method="post" action="">
          <input type="text" name="username" placeholder="Email or Username" class="login-input" required />
          <input type="password" name="password" placeholder="Password" class="login-input" required />
          <p class="login-error">
            <?php echo $message; ?>
          </p>
          <button type="submit" class="login-btn">Log In</button>
        </form>
        <div class="login-separator"></div>
        <div class="signup-link">
          Don't have an account?
          <a href="../signup/signup.php" class="signup-link-span">Sign up</a>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
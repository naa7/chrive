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
  if (
    !empty($_POST['name']) &&
    !empty($_POST['email']) &&
    !empty($_POST['username']) &&
    !empty($_POST['password']) &&
    !empty($_POST['reEnterPassword'])
  ) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $uname = $_POST['username'];
    $rawPassword = $_POST['password'];
    $reEnteredPassword = $_POST['reEnterPassword'];

    if ($rawPassword !== $reEnteredPassword) {
      $message = "Passwords do not match.";
    } else {
      $conn = new mysqli($servername, $username, $password, $dbname);
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      $checkUsernameQuery = "SELECT username FROM user WHERE username = ?";
      $stmt = $conn->prepare($checkUsernameQuery);
      $stmt->bind_param("s", $uname);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0) {
        $message = "Username already exists.";
      } else {
        $checkEmailQuery = "SELECT email FROM user WHERE email = ?";
        $stmt = $conn->prepare($checkEmailQuery);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
          $message = "Email already exists.";
        } else {
          $hashedPassword = password_hash($rawPassword, PASSWORD_DEFAULT);

          $sql = "INSERT INTO user (name, email, username, password) VALUES (?, ?, ?, ?)";
          $stmt = $conn->prepare($sql);
          if ($stmt) {
            $stmt->bind_param("ssss", $name, $email, $uname, $hashedPassword);
            if ($stmt->execute()) {
              $user_id = $stmt->insert_id;
              $_SESSION['user_id'] = $user_id;
              $_SESSION['username'] = $uname;
              header('Location: ../profile/profile.php');

            } else {
              $message = "Error: " . $stmt->error;
            }
            $stmt->close();
          } else {
            $message = "Error: " . $conn->error;
          }
        }
      }

      $conn->close();
    }
  } else {
    $message = "Please fill in all the required fields.";
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Sign Up</title>
  <meta name="description" content="" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <script>
    function validateForm() {
      var password = document.getElementById("password").value;
      var reEnterPassword = document.getElementById("reEnterPassword").value;
      var errorMessage = document.getElementById("error-message");

      if (password !== reEnterPassword) {
        errorMessage.innerHTML = "Passwords do not match.";
        return false;
      } else {
        errorMessage.innerHTML = "";
        return true;
      }
    }
  </script>
  <link rel="stylesheet" type="text/css" href="../reset.css">
  <link rel="stylesheet" href="signup.css" />
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
    <ul class="nav-links right-link">
      <li><a href="../login/login.php">Login</a></li>
    </ul>
  </nav>

  <div class="signup-container">
    <div class="signup-message">SIGN UP</div>
    <div class="signup-body">
      <div class="signup-top"></div>
      <div class="signup-bottom"></div>
      <div class="signup-center">
        <p class="signup-header">Join Chrive today</p>
        <form method="post" action="" onsubmit="return validateForm();">
          <input type="text" name="name" placeholder="Name" class="signup-input" required />
          <input type="text" name="username" placeholder="Username" class="signup-input" required />
          <input type="email" name="email" placeholder="Email" class="signup-input"
            pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required />
          <input type="password" id="password" name="password" placeholder="Password" class="signup-input" required />
          <input type="password" id="reEnterPassword" name="reEnterPassword" placeholder="Re-enter password"
            class="signup-input" required />

          <div class="signup-error" id="error-message">
            <?php echo $message; ?>
          </div>

          <button type="submit" class="signup-btn">Sign up</button>
        </form>
      </div>
    </div>
  </div>
</body>

</html>
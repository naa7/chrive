<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();


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


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (
    !empty($_POST['address']) &&
    !empty($_POST['borough']) &&
    !empty($_POST['zipcode']) &&
    !empty($_POST['dropoff_address']) &&
    !empty($_POST['dropoff_borough']) &&
    !empty($_POST['dropoff_zipcode']) &&
    !empty($_POST['trip_date']) &&
    !empty($_POST['trip_time']) &&
    !empty($_POST['passengers']) &&
    !empty($_POST['phone'])
  ) {
    $pickup_location = $_POST['address'] . ", " . $_POST['borough'] . ", " . $_POST['zipcode'];
    $dropoff_location = $_POST['dropoff_address'] . ", " . ", " . $_POST['dropoff_borough'] . ", " . $_POST['dropoff_zipcode'];
    $trip_date = $_POST['trip_date'];
    $trip_time = $_POST['trip_time'] . ":00";
    $passengers = $_POST['passengers'];
    $phone = $_POST['phone'];



    if ($passengers < 1 || $passengers > 7) {
      $message = "Number of passengers must be between 1 and 7.";
    } elseif (!preg_match('/^\d{3}-\d{3}-\d{4}$/', $phone)) {
      $message = "Phone number must be in the format 123-456-7890.";
    } elseif (!preg_match('/^\d{5}$/', $_POST['zipcode'])) {
      $message = "Zipcode must be 5 digits.";
    } else {
      $conn = new mysqli($servername, $username, $password, $dbname);
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      $stmt = $conn->prepare("INSERT INTO trips_history (user_id, pickup_location, dropoff_location, trip_date, trip_time, passengers, phone)
                              VALUES (?, ?, ?, ?, ?, ?, ?)");
      $stmt->bind_param("issssss", $user_id, $pickup_location, $dropoff_location, $trip_date, $trip_time, $passengers, $phone);

      if ($stmt->execute()) {
        header('Location: profile.php');
      } else {
        echo "Error: " . $stmt->error;
      }

      $stmt->close();
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
  <title>Book a New Trip</title>
  <link rel="stylesheet" type="text/css" href="../reset.css">
  <link rel="stylesheet" href="newTrip.css" />
</head>

<body>
  <nav class="navbar">
    <ul class="nav-links">
      <li>
        <a href="../profile/profile.php">Profile</a>
      </li>
    </ul>
    <ul class="nav-links">
      <li>
        <a href="../trip-history/tripsHistory.php">History</a>
      </li>
    </ul>
    <ul class="nav-links">
      <li>
        <a href="../logout/logout.php">Logout</a>
      </li>
    </ul>
  </nav>
  <div class="newTrip-background-container">
    <form class="order-form" method="post" action="" onsubmit="return validateForm()">
      <p class="header">Book a New Trip</p>
      <table>
        <tr>
          <td class="label-cell"><label>Pickup Address:</label></td>
          <td class="input-cell"><input type="text" id="address" name="address" required placeholder="Street Address"
              value="<?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address']) : ''; ?>" />
          </td>
        </tr>
        <tr>
          <td class="label-cell"></td>
          <td class="input-cell"><input type="text" id="zipcode" name="zipcode" pattern="[0-9]+" inputmode="numeric"
              required placeholder="Zipcode"
              value="<?php echo isset($_POST['zipcode']) ? htmlspecialchars($_POST['zipcode']) : ''; ?>" />
          </td>
        </tr>
        <tr>
          <td class="label-cell"></td>
          <td class="input-cell borough">
            <select id="borough" name="borough" required>
              <option value="" selected disabled>Select Borough</option>
              <option value="Manhattan" <?php echo (isset($_POST['borough']) && $_POST['borough'] == 'Manhattan') ? 'selected' : ''; ?>>Manhattan</option>
              <option value="Brooklyn" <?php echo (isset($_POST['borough']) && $_POST['borough'] == 'Brooklyn') ? 'selected' : ''; ?>>
                Brooklyn</option>
              <option value="Bronx" <?php echo (isset($_POST['borough']) && $_POST['borough'] == 'Bronx') ? 'selected' : ''; ?>>Bronx
              </option>
              <option value="Queens" <?php echo (isset($_POST['borough']) && $_POST['borough'] == 'Queens') ? 'selected' : ''; ?>>
                Queens</option>
              <option value="Staten Island" <?php echo (isset($_POST['borough']) && $_POST['borough'] == 'Staten Island') ? 'selected' : ''; ?>>Staten Island</option>
            </select>

          </td>
        </tr>
        <tr>
          <td class="label-cell"><label>Dropoff Address:</label></td>
          <td class="input-cell"><input type="text" id="dropoff_address" name="dropoff_address" required
              placeholder="Street Address"
              value="<?php echo isset($_POST['dropoff_address']) ? htmlspecialchars($_POST['dropoff_address']) : ''; ?>" />
          </td>
        </tr>
        <tr>
          <td class="label-cell"></td>
          <td class="input-cell"><input type="text" id="dropoff_zipcode" name="dropoff_zipcode" pattern="[0-9]+"
              inputmode="numeric" required placeholder="Zipcode"
              value="<?php echo isset($_POST['dropoff_zipcode']) ? htmlspecialchars($_POST['dropoff_zipcode']) : ''; ?>" />
          </td>
        </tr>
        <tr>
          <td class="label-cell"></td>
          <td class="input-cell borough">
            <select id="dropoff_borough" name="dropoff_borough" required>
              <option value="" selected disabled>Select Borough</option>
              <option value="Manhattan" <?php echo (isset($_POST['dropoff_borough']) && $_POST['dropoff_borough'] == 'Manhattan') ? 'selected' : ''; ?>>Manhattan</option>
              <option value="Brooklyn" <?php echo (isset($_POST['dropoff_borough']) && $_POST['dropoff_borough'] == 'Brooklyn') ? 'selected' : ''; ?>>Brooklyn</option>
              <option value="Bronx" <?php echo (isset($_POST['dropoff_borough']) && $_POST['dropoff_borough'] == 'Bronx') ? 'selected' : ''; ?>>Bronx</option>
              <option value="Queens" <?php echo (isset($_POST['dropoff_borough']) && $_POST['dropoff_borough'] == 'Queens') ? 'selected' : ''; ?>>Queens</option>
              <option value="Staten Island" <?php echo (isset($_POST['dropoff_borough']) && $_POST['dropoff_borough'] == 'Staten Island') ? 'selected' : ''; ?>>Staten Island</option>
            </select>
          </td>
        </tr>
        <tr>
          <td class="label-cell"><label for="trip_date">Date:</label></td>
          <td class="input-cell"><input type="date" id="trip_date" name="trip_date" required
              value="<?php echo isset($_POST['trip_date']) ? htmlspecialchars($_POST['trip_date']) : ''; ?>" /></td>
        </tr>
        <tr>
          <td class="label-cell"><label for="trip_time">Time:</label></td>
          <td class="input-cell"><input type="time" id="trip_time" name="trip_time" required
              value="<?php echo isset($_POST['trip_time']) ? htmlspecialchars($_POST['trip_time']) : ''; ?>" /></td>
        </tr>
        <tr>
          <td class="label-cell"><label for="passengers">Number of Passengers:</label></td>
          <td class="input-cell"><input type="number" id="passengers" name="passengers" required
              value="<?php echo isset($_POST['passengers']) ? htmlspecialchars($_POST['passengers']) : ''; ?>" /></td>
        </tr>
        <tr>
          <td class="label-cell"><label for="phone">Phone Number:</label></td>
          <td class="input-cell"><input type="tel" id="phone" name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required
              oninput="formatPhoneNumber(this)"
              value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>" /></td>
        </tr>
      </table>
      <div class="form-button">
        <span id="zip-error" class="form-error">
          <?php echo $message; ?>
        </span>
        <input type="submit" value="Book Trip" />
      </div>
    </form>
  </div>

  <script>
    function formatPhoneNumber(input) {
      var phoneNumber = input.value.replace(/\D/g, '');
      phoneNumber = phoneNumber.substring(0, 10);
      if (phoneNumber.length >= 7) {
        phoneNumber = phoneNumber.replace(/(\d{3})(\d{3})(\d{4})/, '$1-$2-$3');
      } else if (phoneNumber.length >= 4) {
        phoneNumber = phoneNumber.replace(/(\d{3})(\d{3})/, '$1-$2');
      }
      input.value = phoneNumber;
    }

    function validateForm() {
      var zipInput = document.getElementById('zipcode');
      var zipValue = zipInput.value;
      var zipError = document.getElementById('zip-error');


      if (!/^\d{5}$/.test(zipValue)) {
        zipError.innerHTML = 'Zip code must be 5 digits.';
        zipInput.focus();
        return false;
      }
      zipError.innerHTML = '';
      return true;
    }
  </script>

</body>

</html>
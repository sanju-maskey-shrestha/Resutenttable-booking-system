<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Signup Page</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="signup-container">
    <form action="" method="POST" class="signup-form">
      <h2>Create an Account</h2>
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
      </div>
      <button type="submit">Sign Up</button>
      <p class="login-link">Already have an account? <a href="login.php">Login</a></p>
    </form>
  </div>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Establish database connection
      $servername = "localhost";
      $username = "astro";
      $password = "Serena562181";
      $dbname = "rdbs";

      $conn = new mysqli($servername, $username, $password, $dbname);

      // Check connection
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }

      // Get form data
      $username = $_POST['username'];
      $email = $_POST['email'];
      $password = $_POST['password'];

      // Sanitize data
      $username = mysqli_real_escape_string($conn, $username);
      $email = mysqli_real_escape_string($conn, $email);
      $password = mysqli_real_escape_string($conn, $password);

      // Insert data into signup table
      $sql = "INSERT INTO signup (Username, Email, Password) VALUES ('$username', '$email', '$password')";

      if ($conn->query($sql) === TRUE) {
        // Redirect to login page after successful registration
        header("Location: login.php");
        exit();
    } else {
        echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }

      $conn->close();
  }
  ?>
</body>
</html>

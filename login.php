<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link rel="stylesheet" href="main.css">
</head>
<body>
  <div class="login-container">
    <form action="" method="POST" class="login-form">
      <h2>Welcome Back!</h2>
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
      </div>
      <button type="submit">Login</button>
      <p class="signup-link">Don't have an account? <a href="Sign.php">Sign Up</a></p>
    </form>
  </div>

  <?php
  // Check if the form is submitted
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

      // Get username and password from the form
      $entered_username = $_POST['username'];
      $entered_password = $_POST['password'];

      // Query to check if the username and password match
      $sql = "SELECT * FROM signup WHERE Username='$entered_username' AND Password='$entered_password'";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          // Username and password match
          // Start session and store user information if needed
          session_start();
          $_SESSION['username'] = $entered_username;
          // Redirect to dashboard or home page
          header("Location: dashboard.php");
          exit();
      } else {
          // Username and password do not match
          echo "<p class='error'>Invalid username or password</p>";
      }

      $conn->close();
  }
  ?>
</body>
</html>
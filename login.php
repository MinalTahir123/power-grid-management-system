<!doctype html>
<html lang="en">
  <head>
  <?php
    include 'dbconnect.php';
// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Check if the email and password fields are set
  if (isset($_POST['username']) && isset($_POST['password'])) {
    $email = $_POST['username'];
    $password = $_POST['password'];

    // Assuming you have already established a database connection in $conn
    // Check if the user exists using a prepared statement
    $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
      // Bind the parameters
      $stmt->bind_param("ss", $email, $password);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows == 1) {
        // User found
        $user = $result->fetch_assoc();

        // Determine the user's dashboard
        $domain = substr(strrchr($email, "@"), 1);

        if (strpos($domain, 'techcppa.com') !== false) {
          header("Location: http://localhost/loginsys/technical.php");
        } elseif (strpos($domain, 'financecppa.com') !== false) {
          header("Location: http://localhost/loginsys/finance.php");
        } elseif (strpos($domain, 'billingcppa.com') !== false) {
          header("Location: http://localhost/loginsys/billing.php");
        } else {
          echo "Invalid domain.";
        }
        exit();
      } else {
        echo "Invalid email or password.";
      }
      $stmt->close();
    } else {
      echo "Error preparing the SQL statement.";
    }
  } else {
    echo "Email and password are required.";
  }
}
?>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Power Grid Management System - Login</title>
    <link rel="stylesheet" type="text/css" href="login.css">
  </head>
  <body>
    <form action = "/loginsys/login.php" method = "post">
    <div class="background">
     
      <div class="login-container">
          
          <div class="picture-box">
               <img class="logo" src="logopic/CPPAicon.jpg" alt="Placeholder Image">
          </div>
          <div class="form">
                 <h3>Central Power Purchasing Agency (CPPA)</h3>
                <form action="dashboard.html" method="POST">
                 <label for="username">Email</label>
                 <input type="text" id="username" name="username" required>
                 <br>
                 <label for="password">Password</label>
                 <input type="password" id="password" name="password" required>

                   <div class="forgot-password">
                      <a href="http://localhost/loginsys/forgetpass.php">Forgot Password?</a>
                   </div>

                 <button type="submit">Login</button>
               </form>
          </div>
      </div>
      
    </div>
</form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Sign up </title>
  <link rel="stylesheet" href="./css/signup.css">
</head>
<body>

  <div class="container">
    <div class="content">
      <form action="./backend_register_user.php" method="POST">
      <div class="title">
        <h2>Sign Up</h2>
        <div id="logo"></div>
      </div>
        <div class="user-details">
          <div class="input-box">
            <span class="details">Full Name</span>
            <input type="text"name="fullname" placeholder="Enter your name" required>
          </div>
          <div class="input-box">
            <span class="details">Username</span>
            <input type="text" name="username" placeholder="Enter your username" required>
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="email" placeholder="Enter your email" name="email" required>
          </div>
          <div class="input-box">
            <span class="details">Phone Number</span>
            <input type="text" placeholder="Enter your number" name="phonenumber" required>
          </div>
          <div class="input-box">
            <span class="details">Password</span>
            <input type="password" name="password" placeholder="Enter your password" required>
          </div>
          <div class="input-box">
            <span class="details">Confirm Password</span>
            <input type="password" name="confirm_password" placeholder="Confirm your password" required>
          </div>
        </div>
        <div class="gender-details">
          <input type="radio" name="gender" id="dot-1" value="M">
          <input type="radio" name="gender" id="dot-2" value = "F">
          <input type="radio" name="gender" id="dot-3" value = "N">
          <span class="gender-title">Gender</span>
          <div class="category">
            <label for="dot-1">
              <span class="dot one"></span>
              <span class="gender">Male</span>
            </label>
            <label for="dot-2">
              <span class="dot two"></span>
              <span class="gender">Female</span>
            </label>
            <label for="dot-3">
              <span class="dot three"></span>
              <span class="gender">Prefer not to say</span>
            </label>
          </div>
        </div>
        <p>Already have an account? <a class="links" href="login.php">Login</a></p>
        <div class="button">
          <input name="register" type="submit" value="Register">
        </div>
      </form>
    </div>
  </div>
  <script src="./js/validate_signup.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link rel="stylesheet" href="index.css">
</head>
<body>
  <div class="login-box">
    <h2>Login</h2>
    <form action="login.php" method="post">
      <div class="user-box">
        <input type="text" name="username" required>
        <label for="username">Username</label>
      </div>
      <div class="user-box">
        <input type="password" name="password" required>
        <label for="password">Password</label>
      </div>
      <a href="#" onclick="this.closest('form').submit();">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        Submit
      </a>
    </form>
  </div>
</body>
</html>

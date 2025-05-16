<?php session_start(); include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>
<h2>Admin/Doctor Login</h2>
<form method="POST" action="login_auth.php">
  <input type="text" name="username" required placeholder="Username"><br>
  <input type="password" name="password" required placeholder="Password"><br>
  <button type="submit">Login</button>
</form>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
  <title>Memory game</title>
  <link rel="stylesheet" type="text/css" href="styles/stylesheet_game.css" />
  <script type="text/javascript" src="scripts/jquery-3.1.1.js"></script>
</head>
<body>
  {$menu_section}
  <h1>Registration</h1>
  <div class="container">
    <p>Register your account to keep track of your highscores</p>
    <form action="submit_user_registration.php" method="POST">
      <div class="form_group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username"></input>
      </div>
      <div class="form_group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password"></input>
      </div>
      <div class="form_group">
        <input type="submit"></input>
      </div>
    </form>
  </div>
</body>
</html>

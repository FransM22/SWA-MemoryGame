<!doctype html>

<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="styles/stylesheet_game.css" media="screen" />
    <title>User Information</title>
</head>
<body>

    {$menu_section}

    <h1>User Information</h1>

    <ul class="userinfo">
        <li class="useritem">Current User: {$userid}</li>
        <li class="useritem">Username: {$username}</li>
        <li class="useritem">High Score: {$highscore}</li>
    </ul>

    <form action="logout.php">
      <button type="submit" class="button" >Log Out</button>
    </form>
    <form action="login.php">
      <button type="submit" class="button" >Log in</button>
    </form>
    <form action="register.php">
      <button type="submit" class="button" >Register</button>
    </form>
</body>
</html>

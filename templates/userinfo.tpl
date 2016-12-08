<!doctype html>

<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="styles/stylesheet_game.css" media="screen" />
    <title>User Information</title>
</head>
<body>

    {$menu_section}

    <h1>User Information</h1>

    <div class="container">
      <ul class="userinfo">
          <li class="useritem">Current User: {$userid}</li>
          <li class="useritem">Username: {$username}</li>
          <li class="useritem">High Score: {$highscore}</li>
      </ul>

      {$admin_section}
    </div>

</body>
</html>

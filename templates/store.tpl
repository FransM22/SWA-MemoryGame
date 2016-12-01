<!doctype html>

<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="styles/stylesheet_game.css" media="screen" />
    <title>Web Store</title>
</head>
<body>

    <ul class="navigation">
      <li><a href="index.php">Home</a></li>
      <li><a href="store.php">Web Store</a></li>
      <li><a href="userinfo.php">User Information</a></li>
    </ul>

    <h1>Web Store</h1>

    <ul class="flex-container">
        {$store_items_divs}
    </ul>

    {$admin_section}
</body>
</html>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=yes, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $title ?></title>
</head>
<body>

<form action="/secret.php" method="post">
    <input type="text" name="login" placeholder="login">
    <input type="password" name="pass" placeholder="password">
    <button type="submit">Log in</button>
    <a href="/reset">I forgot my password</a>
</form>

</body>

</html>

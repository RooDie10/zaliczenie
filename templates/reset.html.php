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

<form method="post">
        <ul>
            <li <?php if (isset($errors['email'])): ?>class="error"<?php endif ?>>
                <label for="reset_email">E-mail</label>
                <input
                    type="email"
                    name="reset[email]"
                    id="reset_email"
                    placeholder="example@xmpl.com"
                    value="<?php echo ($data['email'] ?? '') ?>"
                >
                <?php if (isset($errors['email'])): ?>
                    <p><?php echo $errors['email'] ?></p>
                <?php endif ?>
            </li>
            
            <li>
                <button type="submit">Reset</button>
            </li>
        </ul>
    </form>

</body>
</html>
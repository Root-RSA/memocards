<!DOCTYPE html>
<html lang="ru" class="grid">
<head>
    <title>Memo Cards</title>
    <meta charset='UTF-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
</head>
<body class="grid">
<div class="center-me">
    <p class="logo">Memo Cards</p>
    <p>Log in</p>
    <form action="<?= BASE.'login/login'; ?>" method="post">
        <input type="text" name="username" maxlength="20" placeholder="username" size="20" required>
        <input type="text" name="password" maxlength="30" placeholder="password" size="20" required>
        <button type="submit">Sign in</button><br>
        <a class="reg-link" href="<?= BASE.'views/register'; ?>">Not registered yet?</a>
        <p class="err-msg"><?php if(isset($msg)) echo $msg; ?></p>
    </form>
</div>
</body>

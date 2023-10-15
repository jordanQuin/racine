<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/style_connexion.css'); ?>">
</head>

<body>
    <div class="login-container">
        <h2><?= lang('connexion.title') ?></h2>
        <form action="<?= site_url('/Admin/login') ?>" method="post">
            <div class="input-group">
                <label for="username"><?= lang('connexion.username')?></label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password"><?= lang('connexion.password')?></label>
                <input type="password" id="password" name="password" required>
            </div><br>
            <button type="submit"><?= lang('connexion.login_button')?></button>
        </form>
    </div>
</body>

</html>
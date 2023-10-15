<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php $page_name = lang('choix_esclave.title') ?>
    <title><?= $page_name ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/style_connexion.css'); ?>">
</head>
<body>
    
    <div class="login-container">
           <form action="<?= site_url('/modif_esclave') ?>" method="post">
        
           <label><?= lang('choix_esclave.select_slave') ?></label>
           <select name="idE" id="idE" required>
                    <?php
                    if (!empty($auteurs) && is_array($auteurs)) {
                        foreach ($auteurs as $elt) {
                            echo '<option value="' . $elt['id_auteur'] . '">' . $elt['nom'] . ' </option>';
                        }  
                    }
                    ?>
                </select><br><br>
        
           <button type="submit"><?= lang('choix_esclave.modify_button') ?></button>
        </form>
</body>
</html>

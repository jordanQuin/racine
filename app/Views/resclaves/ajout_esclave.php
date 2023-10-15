<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php $page_name = lang('ajout_esclave.title') ?>
    <title><?= $page_name ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/style_connexion.css'); ?>">
</head>
<body>
    <div class="login-container">
           <form action="<?= site_url('Ajout/InsertAuteur') ?>" method="post">
           <label><?= lang('ajout_esclave.name_slave') ?></label>
           <input name="nomR" id="nomR" type="text" required/><br><br>
        
           <label><?= lang('ajout_esclave.year_birth') ?></label>
           <input name="anneeN" id="anneeN" type="number" min="0" max="2030" required/><br><br>

           <label><?= lang('ajout_esclave.location_birth') ?></label>
           <input name="lieuN" id="lieuN" type="text" required/><br><br>

           <label><?= lang('ajout_esclave.year_death') ?></label>
           <input name="dateD" id="dateD" type="text" required/><br><br>
        
           <label><?= lang('ajout_esclave.location_death') ?></label>
           <input name="lieuD" id="lieuD" type="text" required/><br><br>

           <label><?= lang('ajout_esclave.location_slavery') ?></label>
           <input name="lieuE" id="lieuE" type="text" required/><br><br>

           <label><?= lang('ajout_esclave.means_release') ?></label>
           <input name="moy" id="moy" type="text" required/><br><br>

           <label><?= lang('ajout_esclave.location_life_after_release') ?></label>
           <input name="lieuV" id="lieuV" type="text" required/><br><br>

           <label><?= lang('ajout_esclave.origin_parents') ?></label>
           <input name="origP" id="origP" type="text" required/><br><br>
        
           <label><?= lang('ajout_esclave.abolitionist_activist') ?></label>
           <input name="mil" id="mil" type="text" required/><br><br>

           <label><?= lang('ajout_esclave.particularities') ?></label>
           <input name="part" id="part" type="text" required/><br><br>
        
           <button type="submit"><?= lang('ajout_esclave.add_button') ?></button>
        </form>
</body>
</html>

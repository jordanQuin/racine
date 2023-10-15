<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php $page_name = lang('modif_esclave.title') ?>
    <title><?= $page_name ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/style_connexion.css'); ?>">
</head>
<body>


    <div class="login-container">
           <form action="<?= site_url('Modif/ModifAuteur') ?>" method="post">
           <label><?= lang('modif_esclave.name_slave') ?></label>
           <?php
                    if (!empty($auteurs) && is_array($auteurs)) {
                        foreach ($auteurs as $elt) {
                            if ($elt['id_auteur'] == $auteur){
                            echo '<input name="nomE" id="nomE" type="text" value="'. $elt['nom'] .'" required/><br><br>';
                            }
                        }
                    }
            ?>
        
           <label><?= lang('modif_esclave.year_birth') ?></label>
           <?php
                    if (!empty($auteurs) && is_array($auteurs)) {
                        foreach ($auteurs as $elt) {
                            if ($elt['id_auteur'] == $auteur){
                            echo '<input name="anneeN" id="anneeN" type="text"  value="'. $elt['naissance'] .'" required/><br><br>';
                            }
                        }
                    }
            ?>

           <label><?= lang('modif_esclave.location_birth') ?></label>
           <?php
                    if (!empty($auteurs) && is_array($auteurs)) {
                        foreach ($auteurs as $elt) {
                            if ($elt['id_auteur'] == $auteur){
                            echo '<input name="lieuN" id="lieuN" type="text" value="'. $elt['lieu_naissance'] .'" required/><br><br>';
                            }
                        }
                    }
            ?>

           <label><?= lang('modif_esclave.year_death') ?></label>
           <?php
                    if (!empty($auteurs) && is_array($auteurs)) {
                        foreach ($auteurs as $elt) {
                            if ($elt['id_auteur'] == $auteur){
                            echo '<input name="dateD" id="dateD" type="text" value="'. $elt['deces'] .'" required/><br><br>';
                            }
                        }
                    }
            ?>
        
           <label><?= lang('modif_esclave.location_death') ?></label>
           <?php
                    if (!empty($auteurs) && is_array($auteurs)) {
                        foreach ($auteurs as $elt) {
                            if ($elt['id_auteur'] == $auteur){
                            echo '<input name="lieuD" id="lieuD" type="text" value="'. $elt['lieu_deces'] .'" required/><br><br>';
                            }
                        }
                    }
            ?>

           <label><?= lang('modif_esclave.location_slavery') ?></label>
           <?php
                    if (!empty($auteurs) && is_array($auteurs)) {
                        foreach ($auteurs as $elt) {
                            if ($elt['id_auteur'] == $auteur){
                            echo '<input name="lieuE" id="lieuE" type="text" value="'. $elt['lieu_esclavage'] .'" required/><br><br>';
                            }
                        }
                    }
            ?>

           <label><?= lang('modif_esclave.means_release') ?></label>
           <?php
                    if (!empty($auteurs) && is_array($auteurs)) {
                        foreach ($auteurs as $elt) {
                            if ($elt['id_auteur'] == $auteur){
                            echo '<input name="moy" id="moy" type="text" value="'. $elt['moyen_lib'] .'" required/><br><br>';
                            }
                        }
                    }
            ?>

           <label><?= lang('modif_esclave.location_life_after_release') ?></label>
           <?php
                    if (!empty($auteurs) && is_array($auteurs)) {
                        foreach ($auteurs as $elt) {
                            if ($elt['id_auteur'] == $auteur){
                            echo '<input name="lieuV" id="lieuV" type="text" value="'. $elt['lieuvie_ap_lib'] .'" required/><br><br>';
                            }
                        }
                    }
            ?>

           <label><?= lang('modif_esclave.origin_parents') ?></label>
           <?php
                    if (!empty($auteurs) && is_array($auteurs)) {
                        foreach ($auteurs as $elt) {
                            if ($elt['id_auteur'] == $auteur){
                            echo '<input name="origP" id="origP" type="text" value="'. $elt['origine_parents'] .'" required/><br><br>';
                            }
                        }
                    }
            ?>
        
           <label><?= lang('modif_esclave.abolitionist_activist') ?></label>
           <?php
                    if (!empty($auteurs) && is_array($auteurs)) {
                        foreach ($auteurs as $elt) {
                            if ($elt['id_auteur'] == $auteur){
                            echo '<input name="mil" id="mil" type="text" value="'. $elt['militant_abolitionniste'] .'" required/><br><br>';
                            }
                        }
                    }
            ?>

           <label><?= lang('modif_esclave.particularities') ?></label>
           <?php
                    if (!empty($auteurs) && is_array($auteurs)) {
                        foreach ($auteurs as $elt) {
                            if ($elt['id_auteur'] == $auteur){
                            echo '<input name="part" id="part" type="text" value="'. $elt['particularites'] .'" required/><br><br>';
                            }
                        }
                    }
            ?>

            <?php
            echo '<input name="idE" id="idE" type="hidden" value="'. $auteur .'" required/><br><br>';
            ?>
        
           <button type="submit"><?= lang('modif_esclave.modify_button') ?></button>
        </form>
</body>
</html>

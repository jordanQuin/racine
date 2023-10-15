<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $page_name = lang('modif_point.title') ?>
    <title><?= $page_name ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/style_connexion.css'); ?>">
</head>

<body>
    <div class="login-container">
        <h2><?= lang('modif_point.title') ?></h2>
        <form action="<?= site_url('Ajout/modificationPoint') ?>" method="post">
            <div class="input-group">
                <label for="coord"><?= lang('modif_point.coordinates') ?></label>
                <input type="text" id="coord" name="coord" value="<?php echo $coord; ?>" required>
            </div>
            <div class="input-group">
                <label for="ville"><?= lang('modif_point.city') ?></label>
                <input type="ville" id="ville" name="ville"  <?php echo"value=".$ville.""?> required>
            </div>
            <div class="input-group">
                <label for="type"><?= lang('modif_point.type') ?></label>
                <select name="type" id="type">
                    <option value="naissance"><?= lang('modif_point.types.birth') ?></option>
                    <option value="publication"><?= lang('modif_point.types.publication') ?></option>
                    <option value="deces"><?= lang('modif_point.types.death') ?></option>
                    <option value="esclavage"><?= lang('modif_point.types.slavery') ?></option>
                    <option value="lieuvie"><?= lang('modif_point.types.location_life') ?></option>
                </select>
            </div>
            <div class="input-group">
                <label for="recit"><?= lang('modif_point.attach_narrative') ?></label>
                <select name="recit" id="recit">
                    <?php
                    if (!empty($title) && is_array($title)) {
                        foreach ($title as $elt) {
                            if($elt['id_recit'] == $id_recit){
                                //$Licoord = explode(',',$elt['titre']);
                                echo '<option value="' . $elt['id_recit'] . '" selected>' . $elt['nom_esc'] . ' (' . $elt['date_publi'] . ')</option>';
                            }else{
                                echo '<option value="' . $elt['id_recit'] . '">' . $elt['nom_esc'] . ' (' . $elt['date_publi'] . ')</option>';
                            }
                        
                        }
                    }


                    ?>
                </select>
            </div>
            <div class="input-group">
                <!-- champ caché -->
                <input type="hidden" id="id_point" name="id_point" <?php echo'value="'.$id_point.'"'?>>
            </div>
            <button type="submit"><?= lang('modif_point.modify_point_button') ?></button>
        </form>
    </div>
    <div>
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d38842409.43735749!2d-32.80326698876798!3d32.535496033354896!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sfr!2sfr!4v1695204067631!5m2!1sfr!2sfr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</body>

</html>
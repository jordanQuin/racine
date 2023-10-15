<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= lang('modif_recit.title') ?></title> 
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/style_connexion.css'); ?>">
</head>
<body>
    
    <div class="login-container">
           <form action="<?= site_url('Modif/ModifRecit?idR='.$_GET['idR']) ?>" method="post">
           <label><?= lang('modif_recit.name_narrative') ?></label>
           <?php
                    if (!empty($title) && is_array($title)) {
                        foreach ($title as $elt) {
                            if ($elt['id_recit'] == $_GET['idR']){
                            echo '<input name="nomR" id="nomR" type="text" value="'. $elt['titre'] .'"/><br><br>';
                            }
                        }
                    }
            ?>
           <label><?= lang('modif_recit.name_slave') ?></label>
           <select name="idE" id="idE">
                    <?php
                    if (!empty($auteurs) && is_array($auteurs)) {
                        foreach ($auteurs as $elt) {
                            if ($elt['id_auteur'] == $_GET['esc']){
                                echo '<option value="' . $elt['id_auteur'] . '"selected>' . $elt['nom'] . ' </option>'; 
                            } else {
                                echo '<option value="' . $elt['id_auteur'] . '">' . $elt['nom'] . ' </option>';
                            }
                        }  
                    }
                    ?>
                </select><br><br>

           <label><?= lang('modif_recit.location_publication') ?></label>
           <?php
                    if (!empty($title) && is_array($title)) {
                        foreach ($title as $elt) {
                            if ($elt['id_recit'] == $_GET['idR']){
                            echo '<input name="lieuP" id="lieuP" type="text" value="'. $elt['lieu_publi'] .'"/><br><br>';
                            }
                        }
                    }
            ?>
           

           <label><?= lang('modif_recit.year_publication') ?></label>
           <?php
                    if (!empty($title) && is_array($title)) {
                        foreach ($title as $elt) {
                            if ($elt['id_recit'] == $_GET['idR']){
                            echo '<input name="dateP" id="dateP" type="number" min="0" max="2100" value="'. $elt['date_publi'] .'"/><br><br>';
                            }
                        }
                    }
            ?>
        
           <label><?= lang('modif_recit.type_narrative') ?></label>
           <?php
                    if (!empty($title) && is_array($title)) {
                        foreach ($title as $elt) {
                            if ($elt['id_recit'] == $_GET['idR']){
                            echo '<input name="typeR" id="typeR" type="text" value="'. $elt['lieu_publi'] .'"/><br><br>';
                            }
                        }
                    }
            ?>
        
           <label><?= lang('modif_recit.comments') ?></label>
           <?php
                    if (!empty($title) && is_array($title)) {
                        foreach ($title as $elt) {
                            if ($elt['id_recit'] == $_GET['idR']){
                                echo "<input name='com' id='com' type='text' value='" . htmlspecialchars($elt['historiographie']) . "' /><br><br>";

                            }
                        }
                    }
            ?>

           <label><?= lang('modif_recit.method_publication') ?></label>
           <?php
                    if (!empty($title) && is_array($title)) {
                        foreach ($title as $elt) {
                            if ($elt['id_recit'] == $_GET['idR']){
                            echo '<input name="modeP" id="modeP" type="text" value="'. $elt['mode_publi'] .'"/><br><br>';
                            }
                        }
                    }
            ?>
        
          <!--<label>Date de naissance :</label>
           <input name="dateN" id="dateN" type="date" /><br><br> -->

           <label><?= lang('modif_recit.name_writer') ?></label>
           <?php
                    if (!empty($title) && is_array($title)) {
                        foreach ($title as $elt) {
                            if ($elt['id_recit'] == $_GET['idR']){
                            echo '<input name="nomS" id="nomS" type="text" value="'. $elt['scribe_editeur'] .'"/><br><br>';
                            }
                        }
                    }
            ?>
        
           <label><?= lang('modif_recit.link_narrative') ?></label>
           <?php
                    if (!empty($title) && is_array($title)) {
                        foreach ($title as $elt) {
                            if ($elt['id_recit'] == $_GET['idR']){
                            echo '<input name="lienR" id="lienR" type="text" value="'. $elt['lien_recit'] .'"/><br><br>';
                            }
                        }
                    }
            ?>
        
           <button type="submit"><?= lang('modif_recit.modify_button') ?></button>
        </form>
</body>
</html>

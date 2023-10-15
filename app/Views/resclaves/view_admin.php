
<br><br>

<p style="text-align:center; font-size:25px;padding:6px;">  
    Fiche récit</p>

    <div class="rec"><br>
    <p style="text-align:center; font-size:25px; font-style:italic;padding:6px;">

    <?= esc($rec['titre']) ?> </p><br>
</div>
    <br> 
    <div class="rec"><br>
    
        <div class="rec_par">
        <strong><p style="text-align:right;">Année de publication :</strong> <?= esc($rec['date_publi']) ?> </p>
        <strong><p style="text-align:right;">Mode de publication :</strong> <?= esc($rec['mode_publi']) ?> </p>
        <strong><p style="text-align:right;">Plusieurs recits écrits :</strong> <?= esc($rec['plrs_recits']) ?> </p>

    <strong><p>Nom de l'esclave :</strong> <?= esc($rec['nom_esc']) ?> </p>
    <strong><p>Type de récit :</strong> <?= esc($rec['type_recit']) ?> </p>

    <strong><p>Date de naissance :</strong> <?= esc($rec['naissance']) ?> </p>
    <strong><p>Lieu de publication :</strong> <?= esc($rec['lieu_publi']) ?> </p>
    <strong><p>Origine des parents :</strong> <?= esc($rec['origine_parents']) ?> </p>
    <strong><p>Nom du scribe/écrivain :</strong> <?= esc($rec['scribe_editeur']) ?> </p>
    <strong><p>Information supplémentaire :</strong> <?= esc($rec['particularites']) ?> </p>

</div>
<br><br>

<div id="comm">
    <p style="text-align:center;">
        Commentaires / Historiographie: <br><br> 
        <?= esc($rec['historiographie']) ?>
</p>
</div>

<br>
<p>Lien vers le récit : <a href="<?= esc($rec['lien_recit']) ?>"><?= esc($rec['lien_recit']) ?></a></p>


<br><br>
<div style="display:flex;">
<button class="button_return" onclick='window.location.href = 
"<?= site_url()."recits" ?>"'><p>RETOUR VERS LA LISTE DES RÉCITS</p></button>
<button class="button_return" onclick='window.location.href = 
"<?= site_url()."map" ?>"'><p>RETOUR VERS LA CARTE DES RECITS</p></button>
<br><br>
</div>
<br>
    </div>




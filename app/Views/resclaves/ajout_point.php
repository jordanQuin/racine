<!DOCTYPE html>
<html lang="fr">

<?php
$model = new \App\Models\ModelGetPoints();
$lastPoint = $model->getLastPoint();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $page_name = lang('ajout_point.title') ?>
    <title><?= $page_name ?></title>    <!-- Ajout du css pour la carte leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/style_connexion.css'); ?>">
    <!-- Ajout du js pour la carte leaflet -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
</head>

<body>
    <div class="login-container">
        <h2><?= lang('ajout_point.title')?></h2>
        <form action="<?= site_url('Ajout/InsertPoint') ?>" method="post">
            <div class="input-group">
                <label for="coord"><?= lang('ajout_point.coordinates')?></label>
                <input type="text" id="coord" name="coord" required>
            </div>
            <div class="input-group">
                <label for="ville"><?= lang('ajout_point.city')?></label>
                <input type="ville" id="ville" name="ville" required>
            </div>
            <div class="input-group">
                <label for="type"><?= lang('ajout_point.type') ?></label>
                <select name="type" id="type">
                    <option value="naissance"><?= lang('ajout_point.types.birth') ?></option>
                    <option value="publication"><?= lang('ajout_point.types.publication') ?></option>
                    <option value="deces"><?= lang('ajout_point.types.death') ?></option>
                    <option value="esclavage"><?= lang('ajout_point.types.slavery') ?></option>
                    <option value="lieuvie"><?= lang('ajout_point.types.location_life') ?></option>
                </select>
            </div>
            <div class="input-group">
                <label for="recit"><?= lang('ajout_point.attach_narrative')?></label>
                <select name="recit" id="recit">
                    <?php
                    if (!empty($title) && is_array($title)) {
                        foreach ($title as $elt) {
                            //$Licoord = explode(',',$elt['titre']);
                            echo '<option value="' . $elt['id_recit'] . '">' . $elt['nom_esc'] . ' (' . $elt['date_publi'] . ')</option>';
                        }
                    }


                    ?>
                </select>
            </div>
            <!--
            <div class="input-group">
                <label for="point">Id du Recit</label>
                <?php
                echo '<input type="text" id="point" name="point" value="' . $lastPoint . '">';
                ?>
            </div>
                -->
            <button type="submit" id="submit-button" style="display: none;"><?= lang('ajout_point.add_point_button') ?></button>
        </form>
    </div>
    <!-- Div de la map -->
    <div id="map" style="width: 100%; height: 500px;"></div>
   
    <!-- Script pour gérer la carte et récupérer les coordonnées -->
    <script>
        //le setView possède ces valeurs pour avoir une vue d'ensemble des tous les continents sur la carte
        var map = L.map('map').setView([0, 0], 1);
        
        //Référence et configuration de la carte
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        
        //Variable d'affectation qui servira dans la fonction ci-dessous
        var coordInput = document.getElementById("coord");
        var villeInput = document.getElementById("ville");
        
        //Mise du bouton dans une variable pour changer son état (visibilité)
        var submitButton = document.getElementById("submit-button");


        // Ajustez la taille de la zone géographique autour des coordonnées
        var radius = 5.0; // Par exemple, un rayon de 0,01 degré (environ 500 km)


        //Méthode qui permet d'ajouter les coordonées dans la zone de texte souhaité suite à un clic sur la carte
        map.on('click', function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;
            //En suivant la norme ISO 6709 => l'ordre est latitude et longitude
            var coordValue = lat + ','  + lng;
            //Ajout des valeurs dans la zone de texte "Coordonées" suite au clic
            coordInput.value = coordValue;

            // Calcul des coordonnées de la zone géographique autour du clic
            var latMin = lat - radius;
            var latMax = lat + radius;
            var lngMin = lng - radius;
            var lngMax = lng + radius;


            //Ajout de l'api qui permettra d'associer la ville au coordonnées
            fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}&format=json&lat_min=${latMin}&lat_max=${latMax}&lon_min=${lngMin}&lon_max=${lngMax}`)
            //Ajout des villes dans le fichier json
            .then(response => response.json())
            .then(data => {
                if (data.address && data.address.city) {
                    var city = data.address.city || data.address.town || data.address.village || data.address.hamlet;
                    // Ajout de la ville dans la zone de texte "Ville"
                    villeInput.value = city;
                    //Réapparition du bouton car tous les éléments sont renseignés
                    submitButton.style.display = "block"; 
                } else {
                    // Effacer la valeur de la zone de texte "Ville" si aucune ville n'est trouvée
                    villeInput.value = '';

                }
            })
            .catch(error => {
                console.error('Erreur :', error);
                // Effacer la valeur de la zone de texte "Ville" en cas d'erreur
                document.getElementById("ville").value = '';
            });

        });
    </script>
</body>

</html>

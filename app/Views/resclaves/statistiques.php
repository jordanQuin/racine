    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php $page_name = lang('statistiques.title') ?>
        <title><?= $page_name ?></title>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>

    <body>
    <?php
    use App\Libraries\DatabaseUtils;

    $result = DatabaseUtils::selectVisitByMonth();
    $result_visits_year = DatabaseUtils::selectVisitByYear();
    $result_years = Databaseutils::selectYearsVisits();
    $result2 = DatabaseUtils::selectNameOfPage();
    $result3 = DatabaseUtils::selectNumberOfVisitOfPage();

    function generateRandomColor() {
        $r = mt_rand(182, 255); // Valeur aléatoire pour le composant rouge
        $g = mt_rand(88, 151); // Valeur aléatoire pour le composant vert
        $b = mt_rand(68, 92); // Valeur aléatoire pour le composant bleu

        return "rgb($r, $g, $b)";
    }

    $backgroundColorPieChart = array();

    for ($i = 0; $i < 12; $i++) {
        $backgroundColorPieChart[] = generateRandomColor();
    }

    $selectedDate = isset($_POST['selectedDate']) ? $_POST['selectedDate'] : date('Y-m-d'); // Default to today if not set
    $result4 = DatabaseUtils::selectVisitByDay($selectedDate);

    ?>

    <div class="stats-container">
        <div class="box-stats"><br><?= lang('statistiques.number_visits_pages') ?> :<br><br><canvas id="myChart"></div>
        <div class="box-stats"><br><?= lang('statistiques.number_visits_month') ?> :<br><br>
            <div class="box-nombre-visite-mois">
            <?php
            if($result != null){
                echo '<canvas id="myPieChart"></canvas>';
            } else {
                echo 'aucune donnée';
            }
            ?>  
            </div>
        </div>
        <div class="box-stats"><br><?= lang('statistiques.number_visits_year') ?> :<br><br>
            <div class="box-nombre-visite-mois">
            <?php
            if($result != null){
                echo '<canvas id="myPieChart2"></canvas>';
            } else {
                echo 'aucune donnée';
            }
            ?>  
            </div>
        </div>
        <div class="box-stats"><br><?= lang('statistiques.number_visits_day') ?> :<br><br>
            <form action="" method='post'>
            <input type="date" id="datePicker" name="selectedDate" value="<?= $selectedDate ?>" onchange="submitForm()"/>
            </form>
            <br><br>
            <div class="box-nombre-visite-jour">
            <?=$result4?>
            </div>
        </div>
    </div>

    
    <script>
        function submitForm(event) {
        document.querySelector('form').submit();
    }
        // Sélectionnez le canvas
        var ctx = document.getElementById('myChart').getContext('2d');

        // Définissez les données du graphique
        var data = {
            labels: <?= json_encode($result2) ?>,
            datasets: [{
                label: '<?= lang('statistiques.legend_visits_pages') ?>',
                data: <?= json_encode($result3) ?>,
                backgroundColor: 'rgba(255, 151, 92)', // Couleur de remplissage des barres
                borderColor: 'rgba(0,0,0)', // Couleur des bordures
                borderWidth: 1 // Largeur de la bordure
            }]
        };

        // Définissez les options du graphique
        var options = {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        };

        // Créez le graphique
        var myChart = new Chart(ctx, {
            type: 'bar', // Type de graphique
            data: data,
            options: options
        });


    // Sélectionnez le canvas 
        var ctx = document.getElementById('myPieChart').getContext('2d');
        var ctx2 = document.getElementById('myPieChart2').getContext('2d');

        // Définissez les données du graphique (initiallement pour le jour 1)
        var data1 = {
            labels: ['<?= lang('statistiques.months.january') ?>', '<?= lang('statistiques.months.february') ?>', '<?= lang('statistiques.months.march') ?>', '<?= lang('statistiques.months.april') ?>', '<?= lang('statistiques.months.may') ?>', '<?= lang('statistiques.months.june') ?>', '<?= lang('statistiques.months.july') ?>', '<?= lang('statistiques.months.august') ?>', '<?= lang('statistiques.months.september') ?>', '<?= lang('statistiques.months.october') ?>', '<?= lang('statistiques.months.november') ?>', '<?= lang('statistiques.months.december') ?>'],
            datasets: [{
                data: <?= json_encode($result) ?>,
                backgroundColor: <?= json_encode($backgroundColorPieChart) ?>,
                borderColor: ['white'],
                borderWidth: 1
            }]
        };
         var data2 = {
            labels: <?= json_encode($result_years) ?>,
            datasets: [{
                data: <?= json_encode($result_visits_year) ?>,
                backgroundColor: <?= json_encode($backgroundColorPieChart) ?>,
                borderColor: ['white'],
                borderWidth: 1
            }]
        };

        // Définissez les options du graphique
    var options = {
        responsive: false,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        var value = context.formattedValue;
                        var percentage = context.dataset.data[context.dataIndex];
                        if(value > 1){
                            return value + ' <?= lang('statistiques.legend_word_visits') ?>';
                        } else {
                            return value + ' <?= lang('statistiques.legend_word_visit') ?>';
                        }
                    }
                }
            }
        }
    };

        // Créez le graphique initial
        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: data1,
            options: options
        });

         // Créez le graphique initial
         var myPieChart2 = new Chart(ctx2, {
            type: 'pie',
            data: data2,
            options: options
        });
        </script>

    </body>

    </html>
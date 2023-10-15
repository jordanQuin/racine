<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/style_connexion.css'); ?>">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
    <script type="text/javascript">
        (function() {
            emailjs.init("CFprpDhypfb61HdhQ");
        })();
    </script>
</head>

<body>
    <form id="myForm" method="post">
        <div class="login-container">
            <h2><?= lang('contact_resc.title') ?></h2>
            <div class="input-group">
                <label for="name"><?= lang('contact_resc.name') ?></label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="input-group">
                <label for="email"><?= lang('contact_resc.email') ?></label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="message"><?= lang('contact_resc.message') ?></label>
                <textarea id="message" name="message" rows="5" style="resize: none;" required></textarea>
            </div>
            <button type="button" onclick="sendMail()"><?= lang('contact_resc.send_button') ?></button>
        </div>
    </form>

    <script>
        function sendMail() {
            // Récupérer la valeur de l'e-mail
            var email = document.getElementById("email").value;

            // Vérifier si l'e-mail est valide en utilisant une regex
            var emailRegex = /^[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9]{2,4}$/;
            if (!emailRegex.test(email)) {
                alert("Cet email n'est pas valide");
                return; // Arrêter l'envoi du formulaire si l'e-mail n'est pas valide
            }

            // Si l'e-mail est valide, continuer avec l'envoi du formulaire
            var params = {
                from_name: document.getElementById("name").value,
                email_id: email,
                message: document.getElementById("message").value
            };

            emailjs.send("contact_service", "contact_form", params).then(function (res) {
                alert("Message envoyé !");
            });
        }
    </script>

</body>

</html>

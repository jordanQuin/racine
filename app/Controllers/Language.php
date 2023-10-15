<?php namespace App\Controllers;

class Language extends BaseController {
    protected $session;
    protected $language;

    public function __construct() {

        $this->session = \Config\Services::session();
    }

    public function changeLanguage($lang) {
        // Vérifiez que la langue est valide
        $supportedLanguages = ['fr', 'en']; // Ajoutez les langues prises en charge
        if (!in_array($lang, $supportedLanguages)) {
            $lang = $this->request->getLocale();
        }

        // Définir la langue dans la session
        $this->session->set('locale', $lang);

        if(empty($_POST)){
          return redirect()->to('/map');
        } else {

              //on redirige avec la méthode post
              echo '<body><script>
              const form = document.createElement("form");
              form.method = "post";
              form.action = document.referrer;';
              
              if(isset($_POST['idE']) && $_POST['idE'] != null){
                echo 'const idEInput = document.createElement("input");
                idEInput.type = "hidden";
                idEInput.name = "idE";
                idEInput.value = ' . json_encode($_POST['idE']) . ';
                form.appendChild(idEInput);';
              }

              if(isset($_POST['boutonaj']) && $_POST['boutonaj'] != null){
                echo 'const inputBtnAj = document.createElement("input");
                inputBtnAj.type = "hidden";
                inputBtnAj.name = "boutonaj";
                inputBtnAj.value = ' . json_encode($_POST['boutonaj']) . ';
                form.appendChild(inputBtnAj);';
              }

              echo 'const inputLang = document.createElement("input");
                inputLang.type = "hidden";
                inputLang.name = "isLanguageChanged";
                inputLang.value = ' . json_encode('true') . ';
                form.appendChild(inputLang);';
              
              echo 'document.body.appendChild(form);
              form.submit();
          </script>';
          return;

            }
   }

}
<?php
require "abstract/abstractController.php";
class PlayerController extends AbstractController {
    //! Propriétés
    private ViewPlayer $player;
    public function __construct(ViewHeader $header, ViewFooter $footer, InterfaceModel $model, ViewPlayer $player) {
        parent::__construct($header, $footer, $model);
        $this->player = $player;
    }

    //! Getters & Setters
    /**
     * Get the value of player
     *
     * @return ViewPlayer
     */
    public function getPlayer(): ViewPlayer {
        return $this->player;
    }

    /**
     * Set the value of player
     *
     * @param ViewPlayer $player
     *
     * @return self
     */
    public function setPlayer(ViewPlayer $player): self {
        $this->player = $player;
        return $this;
    }

    //! Méthodes

    public function addPlayer(): string {
        $message = "";
        // Form submitted
        if(isset($_POST['submit'])){

            // Checking if inputs are all filled
            if( !empty($_POST['pseudo']) && 
                !empty($_POST['email']) && 
                !empty($_POST['password']) && 
                !empty($_POST['passwordConf'])
                ){

                // Checking that password matches the required characters
                $password = $_POST['password'];
                $uppercase = preg_match('@[A-Z]@', $password);
                $lowercase = preg_match('@[a-z]@', $password);
                $number    = preg_match('@[0-9]@', $password);
                $specialChars = preg_match('@[^\w]@', $password);
                if($uppercase && $lowercase && $number && $specialChars && strlen($password) > 8) {

                    // Correspondance des mots de pass
                    if($_POST['password'] == $_POST['passwordConf']){

                        // Nettoyage des entrées
                        $pseudo = Utils::sanitize($_POST['pseudo']);
                        $email = Utils::sanitize($_POST['email']);

                        // Vérification de la présence de l'email en bdd
                        if(!$this->getModel()->getByEmail($_POST['email'])) {

                            // Hashage du mdp
                            $hash = password_hash(Utils::sanitize($password), PASSWORD_DEFAULT);

                            // Envoi des données au model
                            $this->getModel()->setPseudo($pseudo);
                            $this->getModel()->setEmail($email);
                            $this->getModel()->setPassword($hash);
                            $message = $this->getModel()->add();
                        }
                        else {
                            $message = '<li>Compte déjà existant en bdd</li>';
                        }
                    }
                    else {
                        $message .= '<li>Les mots de passe ne correspondent pas</li>';
                    }
                }
                else {
                    if(!$uppercase){
                        $message .= '<li>Le mot de passe doit contenir une majuscule</li>';
                    }
                    if(!$lowercase){
                        $message .= '<li>Le mot de passe doit contenir une minuscule</li>';
                    }
                    if(!$number){
                        $message .= '<li>Le mot de passe doit contenir un chiffre</li>';
                    }
                    if(!$specialChars){
                        $message .= '<li>Le mot de passe doit contenir un caractère spécial</li>';
                    }
                    if(strlen($password) < 8){
                        $message .= '<li>Le mot de passe doit contenir au moins 8 caractères</li>';
                    }
                }
            }
            else {
                $message = '<li>Veuillez remplir tous les champs</li>';
            }
        }
        return $message;
    }

    public function getAllPlayers(): string {
        $players = $this->getModel()->getAll();
        $cards = "";
        foreach ($players as $player) {
            $pseudo = $player['pseudo'];
            $email = $player['email'];
            $score = $player['score'];
            $cards .= "
                <article>
                    <h2>
                        $pseudo
                    </h2>
                    <h5>
                        $email
                    </h5>
                    <h2>
                        Score : $score
                    </h2>
                </article>
            ";
        }
        return $cards;
    }

    public function render(): void {
        $this->getPlayer()->setMessage($this->addPlayer());
        $this->getPlayer()->setPlayers($this->getAllPlayers());
        echo $this->getHeader()->displayView();
        echo $this->getPlayer()->displayView();
        echo $this->getFooter()->displayView();
    }
}
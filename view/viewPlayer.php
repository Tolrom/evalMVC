<?php
class ViewPlayer {

        //! Propriétés
        private string $message;
        private string $players;

        //! Getters & Setters
        /**
         * Get the value of message
         *
         * @return string
         */
        public function getMessage(): string {
                return $this->message;
        }

        /**
         * Set the value of message
         *
         * @param string $message
         *
         * @return self
         */
        public function setMessage(string $message): self {
                $this->message = $message;
                return $this;
        }

        /**
         * Get the value of players
         *
         * @return string
         */
        public function getPlayers(): string {
                return $this->players;
        }

        /**
         * Set the value of players
         *
         * @param string $players
         *
         * @return self
         */
        public function setPlayers(string $players): self {
                $this->players = $players;
                return $this;
        }

        //! Méthodes

        public function displayView(): string {
            ob_start();
?>
            <section id="register" >
            <h1>Inscription</h1>
                <form action="" method="post">
                    <label>
                        Pseudo :
                        <input type="text" name="pseudo" >
                    </label>
                    <label>
                        Email :
                        <input type="email" name="email" >
                    </label>
                    <label>
                        Mot de passe :
                        <input type="password" name="password">
                    </label>
                    <label>
                        Confirmation :
                        <input type="password" name="passwordConf">
                    </label>
                    <button type="submit" name="submit" >Inscription</button>
                </form>
                <ul><?= $this->getMessage() ?></ul>
            </section>
            <section id="score" >
                <h1>Tableau des scores</h1>
                <?= $this->getPlayers() ?>
            </section>
        <?php
            $view = ob_get_clean();
            return $view;
        }
}

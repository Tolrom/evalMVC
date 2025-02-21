<?php
require "interface/interfaceModel.php";
class PlayerModel implements InterfaceModel{

    //! Propriétés
    private int $id;
    private string $pseudo;
    private string $email;
    private int $score = 0;
    private string $password;
    private \PDO $bdd;
    
    //! Constructeur
    public function __construct() {
        $this->setBdd(Utils::connexion());
    }

    //! Getters & Setters
    /**
     * Get the value of id
     *
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param int $id
     *
     * @return self
     */
    public function setId(int $id): self {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the value of pseudo
     *
     * @return string
     */
    public function getPseudo(): string {
        return $this->pseudo;
    }

    /**
     * Set the value of pseudo
     *
     * @param string $pseudo
     *
     * @return self
     */
    public function setPseudo(string $pseudo): self {
        $this->pseudo = $pseudo;
        return $this;
    }

    /**
     * Get the value of email
     *
     * @return string
     */
    public function getEmail(): string {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param string $email
     *
     * @return self
     */
    public function setEmail(string $email): self {
        $this->email = $email;
        return $this;
    }

    /**
     * Get the value of score
     *
     * @return int
     */
    public function getScore(): int {
        return $this->score;
    }

    /**
     * Set the value of score
     *
     * @param int $score
     *
     * @return self
     */
    public function setScore(int $score): self {
        $this->score = $score;
        return $this;
    }

    /**
     * Get the value of password
     *
     * @return string
     */
    public function getPassword(): string {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @param string $password
     *
     * @return self
     */
    public function setPassword(string $password): self {
        $this->password = $password;
        return $this;
    }

    /**
     * Get the value of bdd
     *
     * @return \PDO
     */
    public function getBdd(): \PDO {
        return $this->bdd;
    }

    /**
     * Set the value of bdd
     *
     * @param \PDO $bdd
     *
     * @return self
     */
    public function setBdd(\PDO $bdd): self {
        $this->bdd = $bdd;
        return $this;
    }

    public function add(): string {
        $account = [
            'pseudo' => $this->getPseudo(),
            'email' => $this->getEmail() ,
            'score' => $this->getScore(),
            'password' => $this->getPassword()
        ];
        try{
            $requete = "INSERT INTO players(pseudo, email, score, psswrd)
            VALUE(?,?,?,?)";
            $req = $this->getBdd()->prepare($requete);
            $req->bindParam(1,$account['pseudo'], PDO::PARAM_STR);
            $req->bindParam(2,$account['email'], PDO::PARAM_STR);
            $req->bindParam(3,$account['score'], PDO::PARAM_STR);
            $req->bindParam(4,$account['password'], PDO::PARAM_STR);
            $req->execute();
            return 'Ajout en bdd correctement effectué.';
        }
        catch(Exception $e) {
            return "Erreur : " . $e->getMessage();
        }
    }

    public function getAll(): ?array {
        
        try {
            $requete = "SELECT id, pseudo, email, score FROM players";
            $req = $this->getBdd()->prepare($requete);
            $req->execute();
            $data = $req->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

    public function getByEmail(string $email): array|null|bool{
        try {
            $requete = "SELECT id, pseudo, email, score, psswrd FROM players
            WHERE email = ?";
            $req = $this->getBdd()->prepare($requete);
            $req->bindParam(1,$email, PDO::PARAM_STR);
            $req->execute();
            $data = $req->fetch(PDO::FETCH_ASSOC);
            return $data;
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
            return null;
        }
    }

}
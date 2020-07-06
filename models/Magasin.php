<?php
/**
 * Created by PhpStorm.
 * User: saralima
 * Date: 25/06/2020
 * Time: 19:34
 */

class Magasin{
    // Connexion
    private $connexion;
    private $table = "magasin"; // Table dans la base de données

    // Propriétés
    public $id;
    public $nom;
    public $ville;
    public $cp;

    /**
     * Constructeur avec $db pour la connexion à la base de données
     *
     * @param $db
     */
    public function __construct($db){
        $this->connexion = $db;
    }

    /**
     * Lecture des magasins
     *
     * @return void
     */
    public function lire(){

        $sql = "SELECT * FROM " . $this->table ;

        // On prépare la requête
        $query = $this->connexion->prepare($sql);

        // On exécute la requête
        $query->execute();

        // On retourne le résultat
        return $query;
    }


    /**
     * Lire un magasin
     *
     * @return void
     */
    public function lireUn(){
        // On écrit la requête
        $sql = "SELECT *  FROM " . $this->table . " WHERE id = :id";
        // On prépare la requête
        $query = $this->connexion->prepare( $sql );

        // On attache l'id
        $query->bindParam(':id', $this->id);

        // On exécute la requête
        $query->execute();

        // on récupère la ligne
        $row = $query->fetch(PDO::FETCH_ASSOC);

        // On hydrate l'objet
        $this->nom = $row['nom'];
        $this->ville = $row['ville'];
        $this->cp = $row['cp'];

    }

    /**
     * Créer un magasin
     *
     * @return bool
     */
    public function creer(){

        // Ecriture de la requête SQL en y insérant le nom de la table
        $sql = "INSERT INTO " . $this->table . " SET nom=:nom, ville=:ville, cp=:cp";

        // Préparation de la requête
        $query = $this->connexion->prepare($sql);

        // Protection contre les injections
        $this->nom=htmlspecialchars(strip_tags($this->nom));
        $this->ville=htmlspecialchars(strip_tags($this->ville));
        $this->cp=htmlspecialchars(strip_tags($this->cp));

        // Ajout des données protégées
        $query->bindParam(":nom", $this->nom);
        $query->bindParam(":ville", $this->ville);
        $query->bindParam(":cp", $this->cp);


        // Exécution de la requête
        if($query->execute()){
            return true;
        }
        return false;
    }

    /**
     * Mettre à jour un magasin
     *
     * @return bool
     */
    public function modifier(){
        // On écrit la requête
        $sql = "UPDATE " . $this->table . " SET nom = :nom, ville = :ville, cp = :cp";

        // On prépare la requête
        $query = $this->connexion->prepare($sql);

        // On sécurise les données
        $this->nom=htmlspecialchars(strip_tags($this->nom));
        $this->ville=htmlspecialchars(strip_tags($this->ville));
        $this->cp=htmlspecialchars(strip_tags($this->cp));


        // On attache les variables
        $query->bindParam(':nom', $this->nom);
        $query->bindParam(':ville', $this->ville);
        $query->bindParam(':cp', $this->cp);


        // On exécute
        if($query->execute()){
            return true;
        }

        return false;
    }

    /**
     * Supprimer un magasin
     *
     * @return bool
     */
    public function supprimer(){
        // On écrit la requête
        $sql = "DELETE FROM " . $this->table . " WHERE id = ?";

        // On prépare la requête
        $query = $this->connexion->prepare( $sql );

        // On sécurise les données
        $this->id=htmlspecialchars(strip_tags($this->id));

        // On attache l'id
        $query->bindParam(1, $this->id);

        // On exécute la requête
        if($query->execute()){
            return true;
        }

        return false;
    }


}
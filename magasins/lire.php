<?php
/**
 * Created by PhpStorm.
 * User: saralima,
 * Date: 25/06/2020
 * Time: 20:20
 */

// Headers requis
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// On vérifie que la méthode utilisée est correcte
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    // On inclut les fichiers de configuration et d'accès aux données
    include_once '../config/Database.php';
    include_once '../models/Magasin.php';

    // On instancie la base de données
    $database = new Database();
    $db = $database->getConnection();

    // On instancie les magasins
    $magasin = new Magasin($db);

    // On récupère les données
    $stmt = $magasin->lire();

    // On vérifie si on a au moins 1 magasin
    if($stmt->rowCount() > 0){
        // On initialise un tableau associatif
        $tableauMagasin = [];
        $tableauMagasin['magasins'] = [];

        // On parcourt les magasins
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $magasins = [
                "id" => $row['id'],
                "nom" => $row['nom'],
                "ville" => $row['ville'],
                "cp" => $row['cp'],

            ];

            $tableauMagasin['magasins'][] = $magasins;
        }

        // On envoie le code réponse 200 OK
        http_response_code(200);

        // On encode en json et on envoie
        echo json_encode($tableauMagasin);
    }

}else{
    // On gère l'erreur
    http_response_code(405);
    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
}
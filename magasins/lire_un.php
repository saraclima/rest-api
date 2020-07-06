<?php
/**
 * Created by PhpStorm.
 * User: saralima
 * Date: 25/06/2020
 * Time: 20:21
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

    $donnees = json_decode(file_get_contents("php://input"));

    if(!empty($donnees->id)){
        $magasin->id = $donnees->id;

        // On récupère le magasin
        $magasin->lireUn();

        // On vérifie si le magasin existe
        if($magasin->nom != null){

            $prod = [
                "id" => $magasin->id,
                "nom" => $magasin->nom,
                "ville" => $magasin->ville,
                "cp" => $magasin->cp,
            ];
            // On envoie le code réponse 200 OK
            http_response_code(200);

            // On encode en json et on envoie
            echo json_encode($prod);
        }else{
            // 404 Not found
            http_response_code(404);

            echo json_encode(array("message" => "Le magasin n'existe pas."));
        }

    }
}else{
    // On gère l'erreur
    http_response_code(405);
    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
}
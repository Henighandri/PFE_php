<?php
/*
 * Création d’un nouveau produit
 * les détails du produit sont lus à partir d’une requête Post HTTP
 */
 // array for JSON response
$response = array();

// Vérifier les champs demandés 
if (isset($_POST['name']) ) {
    $name_table = $_POST["name"];
  
	
// import database connection variables
 include 'db_config.php';
	
	// Connexion à au serveur        
          $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD) or die(mysqli_error());
        // Selectionner la base de données
        $db = mysqli_select_db($con,DB_DATABASE) or die(mysqli_error());
 
    // creation d'un nouveau tableau
    $result = mysqli_query($con,"DROP TABLE $name_table");
    $result2=mysqli_query($con,"DELETE FROM `control_water_level` WHERE `control_water_level`.`name_plant` = '$name_table'");
 
    // tester si le nouveau produit est inséré ou non
    if ($result && $result2) {
        // insertion avec succès dans la base de données
        $response["success"] = 1;
        $response["message"] = "successfull";
 
        // afficher la réponse JSON
        echo json_encode($response);
    } else {
        // Echec d’insertion
        $response["success"] = 0;
        $response["message"] = "Erreur";
 
        // afficher la réponse JSON
        echo json_encode($response);
    }
} else {
    // données manquantes
    $response["success"] = 0;
    $response["message"] = "donnees manquantes";
 
    // afficher la réponse JSON
    echo json_encode($response);
}
?>

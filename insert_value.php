<?php
/*
 * Création d’un nouveau produit
 * les détails du produit sont lus à partir d’une requête Post HTTP
 */
 // array for JSON response
$response = array();

// Vérifier les champs demandés 
if( isset($_POST['plante']) && isset($_POST['temperature']) && isset($_POST['humidite']) && isset($_POST['q_eau'])) {
   
    //isset($_POST['plante']) 
      
    $table = $_POST['plante'];
     $temperature = $_POST['temperature'] ;
       $q_eau = $_POST['q_eau'];
      $humidite = $_POST['humidite'];
  
// import database connection variables
 include 'db_config.php';
	
	// Connexion à au serveur        
          $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD) or die(mysqli_error());
        // Selectionner la base de données
        $db = mysqli_select_db($con,DB_DATABASE) or die(mysqli_error());
 
    // insertion  d'une nouvelle plante
    $result = mysqli_query($con,"INSERT INTO $table(temperature,humidite,q_eau) 
    VALUES ('$temperature','$humidite','$q_eau')")or die(mysqli_error($con));

    // tester si le nouveau produit est inséré ou non
    if ($result) {
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

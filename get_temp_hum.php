<?php
 
/*
 * Following code will list all the products
 */
 
// array for JSON response
$response = array();
 
// import database connection variables
include 'db_config.php';
 // Connexion à au serveur        
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD) or die(mysqli_error());
// Selectionner la base de données
$db = mysqli_select_db($con,DB_DATABASE) or die(mysqli_error());
 
 if (isset($_POST['name_plante']) ) {
$name_plante=$_POST['name_plante'];

$result = mysqli_query($con,"SELECT temperature,humidite  FROM info_plante   where info_plante.name='$name_plante' ;" ) or die(mysqli_error());

 
// check for empty result
if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["$name_plante"] = array();
 
    while ($row = mysqli_fetch_array($result) ) {
        // temp user array
        $plante = array();
        
      
        $plante["temperature"] = $row["temperature"];
        $plante["humidite"] = $row["humidite"];
        
        
 
        // push single product into final response array
        array_push($response["$name_plante"], $plante);
    }
    // success
 
 
    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
   
    $response["message"] = "n'existe pas";
 
    // echo no users JSON
    echo json_encode($response);}
} else {
    // données manquantes

    $response["message"] = "donnees manquantes";
 
    // afficher la réponse JSON
    echo json_encode($response);
}

?>

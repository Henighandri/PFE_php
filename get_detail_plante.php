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
 if (isset($_POST['name']) ) {

$name_table=$_POST['name'];

$result = mysqli_query($con,"SELECT $name_table.* ,info_plante.description FROM $name_table ,info_plante  where info_plante.name='$name_table' ;" ) or die(mysqli_error());

 
// check for empty result
if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["$name_table"] = array();
 
    while ($row = mysqli_fetch_array($result) ) {
        // temp user array
        $plante = array();
        
      
    $plante["temperature"] = $row["temperature"];
        $plante["humidite"] = $row["humidite"];
        $plante["description"] = $row["description"];
        $plante["q_eau"] = $row["q_eau"];
 
        // push single product into final response array
        array_push($response["$name_table"], $plante);
    }
    // success
    $response["success"] = 1;
 
    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "n'existe pas";
 
    // echo no users JSON
    echo json_encode($response);}
} else {
    // données manquantes
    $response["success"] = 0;
    $response["message"] = "donnees manquantes";
 
    // afficher la réponse JSON
    echo json_encode($response);
}

?>

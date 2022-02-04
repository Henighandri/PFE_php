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
 
// get all products from products table
$result = mysqli_query($con,"SELECT * FROM info_plante") or die(mysqli_error());
 
// check for empty result
if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["info_plante"] = array();
 
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $plante = array();
        
        $plante["name"] = $row["name"];
        $plante["temperature"] = $row["temperature"];
        $plante["humidite"] = $row["humidite"];
        $plante["description"] = $row["description"];
 
        // push single product into final response array
        array_push($response["info_plante"], $plante);
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
    echo json_encode($response);
}
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>




<?php
 
/*
 * Following code will get single Leraar details
 * A Leraar is identified by Leraar id (ID)
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();
 
$validInput = 0;

// check for post data
if (isset($_GET["submit"])) {
    
    $validInput = 2;
    $fullStr = $_GET["ID"];

    $arrayParts = explode(", ", $fullStr);
    
    print_r($arrayParts);
    echo "<br> <br>";
    
    if(count($arrayParts)> 1){
    $table = array_values($arrayParts)[0];

    $idNumber = array_values($arrayParts)[1];
    
     if($table == "Leraar"){
    
         $validInput = 1;
         
    // get a Leraar from Leraar table
    $result = mysql_query('SELECT * FROM Leraar WHERE ID = '. $idNumber .' ');
 
    if (!empty($result)) {
        
        // check for empty result
        if (mysql_num_rows($result) > 0) {
 
            $result = mysql_fetch_array($result);
 
            $Leraar = array();
            $Leraar["ID"] = $result["ID"];
            $Leraar["Naam"] = $result["Naam"];
//            $Leraar["price"] = $result["price"];
//            $Leraar["description"] = $result["description"];
//            $Leraar["created_at"] = $result["created_at"];
//            $Leraar["updated_at"] = $result["updated_at"];
//            // success
            $response["success"] = 1;
 
            // user node
            $response["Leraar"] = array();
 
            array_push($response["Leraar"], $Leraar);
 
            // echoing JSON response
            echo json_encode($response);
        } else {
            // no Leraar found
            $response["success"] = 0;
            $response["message"] = "No Leraar found";
 
            // echo no users JSON
            echo json_encode($response);
        }
    } else {
        // no Leraar found
    
        $response["success"] = 0;
        $response["message"] = "No Leraar found2";
        
 
        // echo no users JSON
        echo json_encode($response);
    }
     }
     
          if($table == "Lokaal"){
              
              $validInput = 1;
    
    // get a Lokaal from Lokaal table
    $result = mysql_query('SELECT * FROM Lokaal WHERE ID = '. $idNumber .' ');
 
    if (!empty($result)) {
        
        // check for empty result
        if (mysql_num_rows($result) > 0) {
 
            $result = mysql_fetch_array($result);
 
            $Lokaal = array();
            $Lokaal["ID"] = $result["ID"];
            $Lokaal["Nummer"] = $result["Nummer"];
            $Lokaal["Functie"] = $result["Functie"];
//            $Lokaal["description"] = $result["description"];
//            $Lokaal["created_at"] = $result["created_at"];
//            $Lokaal["updated_at"] = $result["updated_at"];
//            // success
            $response["success"] = 1;
 
            // user node
            $response["Lokaal"] = array();
 
            array_push($response["Lokaal"], $Lokaal);
 
            // echoing JSON response
            echo json_encode($response);
        } else {
            // no Lokaal found
            $response["success"] = 0;
            $response["message"] = "No Lokaal found";
 
            // echo no users JSON
            echo json_encode($response);
        }
    } else {
        // no Lokaal found
    
        $response["success"] = 0;
        $response["message"] = "No Lokaal found2";
        
 
        // echo no users JSON
        echo json_encode($response);
    }
    
    
    
    
    
    
    
    
    
    } }
    elseif($validInput != 1) {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing or wrong input";
 
    // echoing JSON response
    echo json_encode($response);
    }
    elseif ($validInput == 2) {
        // submit failed
    $response["success"] = 0;
    $response["message"] = "Submit failed! try again.";
 
    // echoing JSON response
    echo json_encode($response);
}



}
?>







        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
            <p>Add Tabel & ID separated by comma</p>
            <p>QR: <input type="text" name="ID"
                                 /></p>
               
            <p><input type="submit" name="submit"
                      value="Submit" />
        
        </form>
        
    </body>
</html>

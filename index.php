<?php
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();
if($_GET["ID"] !== "")
{
    $test = $_GET["ID"];
    $type = $_GET["Type"];
    $result = mysql_query("SELECT *FROM $type WHERE ID =$test") or die(mysql_error());

    if (mysql_num_rows($result) > 0) {
        $response[$type] = array();
        while ($row = mysql_fetch_array($result)) {
            // temp user array
            $product = array();
            if ($type === "Leraar")
            {
                $product['id'] = $row[0];
                $product['name'] = $row[1];
            }
            if ($type === "Vak")
            {
                $product['id'] = $row[0];
                $product['name'] = $row[1];
            }
            if ($type === "Lokaal")
            {
                $product['id'] = $row[0];
                $product['locatie'] = $row[1];
                $product['functie'] = $row[2];
            }
            array_push($response[$type], $product);
        }
        echo json_encode($response);
    } 
    else 
    {
        $response["success"] = 0;
        $response["message"] = "No products found";
        echo json_encode($response);
    }
}
?>
<?php

$response = array();
$response["success"] = false;

require_once(__DIR__ . '/db_connect.php');
$db = new DB_CONNECT();

if($db->error !== null) {
    $response["error"] = $db->error;
} else {
    $id = isset($_GET["ID"]) ? $_GET["ID"] : null;

    if($id == null) {
        $response["error"] = "ID invoer verplicht";
    } else {
        $stmt = $db->con->prepare("SELECT QRCode.Tekst FROM QRCode WHERE ID = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($tekst);
        $stmt->fetch();
        $stmt->close();

        $response["tekst"] = $tekst;

        $stmt = $db->con->prepare("SELECT Leraar.Naam, (SELECT GROUP_CONCAT(Vak.Naam) FROM Vak, Vakken WHERE Vakken.Leraar = Leraren.Leraar AND Vak.ID = Vakken.Vak) AS GegevenVakken FROM Leraar, Leraren WHERE Leraren.QRCode = ? AND Leraar.ID = Leraren.Leraar");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($naam, $vakken);

        $leraren = array();
        while ($stmt->fetch()) {
            array_push($leraren, array($naam => $vakken));
        }

        if(count($leraren) > 0) $response["leraren"] = $leraren;

        $stmt->close();

        $stmt = $db->con->prepare("SELECT Lokaal.Nummer, Lokaal.Functie FROM Lokaal, Lokalen WHERE Lokalen.QRCode = ? AND Lokaal.ID = Lokalen.Lokaal");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($nummer, $functie);

        $lokalen = array();
        while ($stmt->fetch()) {
            array_push($lokalen, array($nummer => $functie));
        }

        if(count($lokalen) > 0) $response["lokalen"] = $lokalen;

        $stmt->close();

        $response["success"] = true;
    }
}

header("Content-type: application/json");
echo json_encode($response);
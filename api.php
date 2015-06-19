<?php

//kijken of er response is
$response = array();
$response["success"] = false;

//database connectie maken via link naar db_connect.php
require_once(__DIR__ . '/db_connect.php');
$db = new DB_CONNECT();

if ($db->error !== null)
{
    $response["error"] = $db->error;
} else
{
    $id = isset($_GET["ID"]) ? $_GET["ID"] : null;

    if ($id == null)
    {
        $response["error"] = "ID invoer verplicht";

        //gegevens uit database halen en opslaan
    } else
    {
        $stmt = $db->con->prepare("SELECT qrcode.Tekst FROM qrcode WHERE ID = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->store_result();
        $rows = $stmt->num_rows;
        $stmt->bind_result($tekst);
        $stmt->fetch();
        $stmt->close();

        if ($rows == 0)
        {
            $response["error"] = "geen resultaten";
        } else
        {
            $response["tekst"] = $tekst;

            //gegevens uit database halen en opslaan
            $stmt = $db->con->prepare("SELECT leraar.Naam, (SELECT GROUP_CONCAT(vak.Naam) FROM vak, vakken WHERE vakken.Leraar = leraar.Leraar AND vak.ID = vakken.Vak) AS GegevenVakken FROM leraar, leraren WHERE leraren.QRCode = ? AND leraar.ID = leraren.Leraar");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->bind_result($naam, $vakken);

            $leraren = array();
            while ($stmt->fetch())
            {
                $leraren[$naam] = $vakken;
            }

            if (count($leraren) > 0)
                $response["leraren"] = $leraren;

            $stmt->close();

            //gegevens uit database halen en opslaan
            $stmt = $db->con->prepare("SELECT lokaal.Nummer, lokaal.Functie FROM lokaal, lokalen WHERE lokalen.QRCode = ? AND lokaal.ID = lokalen.Lokaal");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->bind_result($nummer, $functie);

            $lokalen = array();
            while ($stmt->fetch())
            {
                $lokalen[$nummer] = $functie;
            }

            if (count($lokalen) > 0)
                $response["lokalen"] = $lokalen;

            $stmt->close();

            $response["success"] = true;
        }
    }
}
//aangeven dat datatype json is en array omzetten in json en uitprinten
header("Content-type: application/json");
echo json_encode($response);

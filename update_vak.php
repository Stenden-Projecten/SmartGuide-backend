<?php require_once(__DIR__ . "/db_config.php"); ?>
<!DOCTYPE>
<html>
    <head>
        <meta charset="UTF-8">
        <title>updated</title>
        <link href='opmaak.css' rel='stylesheet'>
    </head>
    <body>

        <?php
        $ID = $_GET['id'];
        $Naam = $_GET['Naam'];

        if (!isset($_GET['Naam']) || empty($_GET['Naam']))
        {
            echo "Kon " . $Naam . " niet updaten, misschien zijn er lege velden";
        } else
        {
            @mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD);
            @mysql_select_db(DB_DATABASE) or die("Unable to select database");
            $query = "UPDATE vak SET Naam='$Naam' WHERE ID='$ID'";
            mysql_query($query) OR DIE(mysql_error());
            echo "De tabel is geupdated";

            mysql_close();
        }
        ?>

        <br/>
        <a href="change_db_page.php">terug naar overzicht</a>
    </body>
</html>
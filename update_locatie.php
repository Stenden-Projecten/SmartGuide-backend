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
        $Nummer = $_GET['Nummer'];
        $Functie = $_GET['Functie'];

        if (!isset($_GET['Nummer']) || !isset($_GET['Functie']) || empty($_GET['Nummer']) || empty($_GET['Functie']))
        {
            echo "Kon de rij niet updaten, misschien zijn er lege velden";
        } else
        {
            @mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD);
            @mysql_select_db(DB_DATABASE) or die("Unable to select database");
            $query = "UPDATE lokaal SET Nummer='$Nummer', Functie='$Functie' WHERE ID='$ID'";
            mysql_query($query) OR DIE(mysql_error());
            echo "De bug is geupdated";
            
            mysql_close();
        }
        ?>

        <br/>
        <a href="change_db_page.php">terug naar overzicht</a>
    </body>
</html>
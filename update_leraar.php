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

        //kijken of naam veld is ingevuld, als die leeg is komt bericht.
        //is het niet leeg dan wordt naam ge update in de database tabel
        if (!isset($_GET['Naam']) || empty($_GET['Naam']))
        {
            echo "Kon " . $Naam . " niet updaten, misschien zijn er lege velden";
        } else
        {
            mysql_connect("localhost", "root", "");
            mysql_select_db('smartguide') or die("Unable to select database");
            //hier wordt de naam in de leraar tabel gezet
            $query = "UPDATE leraar SET Naam='$Naam' WHERE ID='$ID'";
            mysql_query($query) OR DIE(mysql_error());
            echo "De tabel is geupdated";

            mysql_close();
        }
        ?>

        <br/>
        <a href="change_db_page.php">terug naar overzicht</a>
    </body>
</html>
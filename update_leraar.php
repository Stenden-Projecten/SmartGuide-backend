<!DOCTYPE>
<html>
    <head>
        <meta charset="UTF-8">
        <title>updated</title>
        <link href='opmaak.css' rel='stylesheet'>
    </head>
    <body>
        
        <?php
        $ID = $_POST['ID'];
        $Naam = $_POST['Naam'];

        mysql_connect("localhost", "root", "");
        @mysql_select_db('smartguide') or die("Unable to select database");
        $query = "UPDATE leraar SET ID='$ID', Naam='$Naam'";
        mysql_query($query) OR DIE(mysql_error());
        echo "De bug is geupdated";
        mysql_close();
        ?>

        <br/>
        <a href="change_db_page.php">terug naar overzicht</a>
    </body>
</html>
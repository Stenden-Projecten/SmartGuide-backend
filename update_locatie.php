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

        mysql_connect("localhost", "root", "");
        mysql_select_db('smartguide') or die("Unable to select database");
        $query = "UPDATE lokaal SET ID='$ID', Nummer='$Nummer', Functie='$Functie'";
        mysql_query($query) OR DIE(mysql_error());
        echo "De bug is geupdated";
        mysql_close();
        ?>

        <br/>
        <a href="change_db_page.php">terug naar overzicht</a>
    </body>
</html>
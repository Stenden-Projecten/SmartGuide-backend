<!DOCTYPE>
<html>
    <head>
        <title>update database</title>
        <link href='opmaak.css' rel='stylesheet'>
    </head>
    <body>
        <div id='menu'>
            <ul>
                <li>
                    <a href="login.php">log in</a>
                </li>
                <li>
                    <a href="logout_page.php">log out</a>
                </li>
                <li>
                    <a href="change_db_page.php">Back to tables</a>
                </li>
            </ul>
        </div>

        <?php
        session_start();

        $DBconnect = mysql_connect("localhost", "root", "") OR DIE("unable to connect");
        $dbMessage = "could not find database: ";
        $db = mysql_select_db("smartguide", $DBconnect) OR DIE("<div id='berichtje'> " . $dbMessage . mysql_error() . "</div>");

        if (isset($_POST['display']))
        {
            switch ($_POST['display'])
            {
                case 'Leraar':
                    $query = mysql_query("select * from leraar", $DBconnect);
                    while ($row = mysql_fetch_array($query))
                    {
                        echo "<div id='text'>";
                        //id=<?php echo $_GET['id']; ?" method="POST"
                        //echo "ID: {$row['ID']} <a href = "update_leraar.php?id=<?php echo $_GET['id']; ?" method="POST"</a><br/>";
                        echo "ID: {$row['ID']} <a href = 'update_leraar.php?id={$row['ID']}&Type=LeraarID'>update</a><br/>";
                        echo "Naam: {$row['Naam']} <a href = 'update_leraar.php?id={$row['ID']}&Type=LeraarNaam'>update</a>";
                        echo "</div>";
                    }
                    break;

                case 'Vak':
                    $query = mysql_query("select * from vak", $DBconnect);
                    while ($row = mysql_fetch_array($query))
                    {
                        echo "<div id='text'>";
                        echo "ID: {$row['ID']} <a href = 'Updated.php?id={$row['ID']}&Type=VakID'>update</a><br/>";
                        echo "Naam: {$row['Naam']} <a href = 'Updated.php?id={$row['ID']}&Type=VakNaam'>update</a>";
                        echo "</div>";
                    }
                    break;

                case 'Locatie':
                    $query = mysql_query("select * from lokaal", $DBconnect);
                    echo "<table id='t1'>";
                    echo "<tr id='trOut'><th>ID</th><th>Naam</th><th>Functie</th></tr>";
                    while ($row = mysql_fetch_array($query))
                    {
                        //echo "<div id='text'>";
                        echo "<tr id='trIn'><td>{$row['ID']} <a href = '?id={$row['ID']}&Type=LocatieID'>update</a></td><br/>";
                        echo "<td>{$row['Nummer']} <a href = '?id={$row['ID']}&Type=LocatieNummer'>update</a></td><br/>";
                        echo "<td>{$row['Functie']} <a href = '?id={$row['ID']}&Type=LocatieFunctie'>update</a></td></tr>";
                        //echo "</div>";
                    }
                    echo "</table>";
                    break;

                case 'Qrcode':
                    $query = mysql_query("select * from QRCode", $DBconnect);
                    while ($row = mysql_fetch_array($query))
                    {
                        echo "<div id='text'>";
                        echo "ID: {$row['ID']} <a href = '?id={$row['ID']}&Type=QrcodeID'>update</a><br/>";
                        echo "Tekst: {$row['Tekst']} <a href = '?id={$row['ID']}&Type=QrcodeTekst'>update</a>";
                        echo "</div>";
                    }
                    break;
            }
        }
        mysql_close();
        ?>

    </body>
</html>
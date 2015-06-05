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
                    echo "<table id='t1' border='1'>";
                    echo "<tr id='trOut'><th id='thUp'>ID</th><th>Naam</th><th></th><th></th></tr>";
                    while ($row = mysql_fetch_array($query))
                    {
                        echo "<form method='GET' action='update_leraar.php'>";
                        echo "<tr id='trIn'><td>{$row['ID']}</td>";
                        echo "<input type='hidden' name='id' value='{$row['ID']}'/>";
                        echo "<input type='hidden' type='LeraarNaam' value='{$row['Naam']}'/>";

                        echo "<td>{$row['Naam']}</td><td><input type='text' value='{$row['Naam']}' name='Naam' size='15'></td><td>"
                        . "<input type='submit' value='update' name='submit' id='submit'/></td></tr>";
                        echo "</form>";
                    }
                    break;

                case 'Vak':
                    $query = mysql_query("select * from vak", $DBconnect);
                    echo "<table id='t2' border='1'>";
                    echo "<tr id='trOut'><th id='thUp'>ID</th><th>Naam</th><th></th><th></th></tr>";
                    while ($row = mysql_fetch_array($query))
                    {
                        echo "<form method='GET' action='update_vak.php'>";
                        echo "<tr id='trIn'><td>{$row['ID']}</td>";
                        echo "<input type='hidden' name='id' value='{$row['ID']}'/>";
                        echo "<input type='hidden' type='VakNaam' value='{$row['Naam']}'/>";

                        echo "<td>{$row['Naam']}</td><td><input type='text' value='{$row['Naam']}' name='Naam' size='20'></td><td>"
                        . "<input type='submit' value='update' name='submit' id='submit'/></td></tr>";
                        echo "</form>";
                    }
                    break;

                case 'Locatie':
                    $query = mysql_query("select * from lokaal", $DBconnect);
                    
                    echo "<table id='t3' border='1'>";
                    echo "<tr id='trOut'><th id='thUp'>ID</th><th></th><th>Nummer</th><th></th><th>Functie</th><th></th><th></th></tr>";
                    while ($row = mysql_fetch_array($query))
                    {
                        echo "<form method='GET' action='update_locatie.php'>";
                        echo "<tr id='trIn'><td>{$row['ID']}</td>";
                        echo "<input type='hidden' name='id' value='{$row['ID']}'/>";
                        echo "<input type='hidden' type='LocatieNummer' value='{$row['Nummer']}'/>";
                        echo "<input type='hidden' type='LocatieFunctie' value='{$row['Functie']}'/>";

                        echo "<td>{$row['Nummer']}</td><td><input type='text' value='{$row['Nummer']}' name='Nummer' size='10'></td>";
                        echo "<td>{$row['Functie']}</td><td><textarea rows='1' cols='10' value='{$row['Functie']}' name='Functie'></textarea></td><td>"
                        . "<input type='submit' value='update' name='submit' id='submit'/></td></tr>";
                        echo "</form>";
                    }
                    echo "</table>";
                    break;

                case 'Qrcode':
                    $query = mysql_query("select * from QRCode", $DBconnect);
                    echo "<table id='t4' border='1'>";
                    echo "<tr id='trOut'><th id='thUp'>ID</th><th>Tekst</th><th></th><th></th></tr>";
                    while ($row = mysql_fetch_array($query))
                    {
                        echo "<form method='GET' action='update_qrcode.php'>";
                        echo "<tr id='trIn'><td>{$row['ID']}</td>";
                        echo "<input type='hidden' name='id' value='{$row['ID']}'/>";
                        echo "<input type='hidden' type='QrcodeTekst' value='{$row['Tekst']}'/>";

                        echo "<td>{$row['Tekst']}</td><td><input type='text' name='Tekst' size='20'></td><td>"
                        . "<input type='submit' value='update' name='submit' id='submit'/></td></tr>";
                        echo "</form>";
                    }
                    break;
            }
        }
        mysql_close();
        ?>

    </body>
</html>
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
                        echo "<tr id='trIn'><td>{$row['ID']}</td><br/>";
                        echo "<td>{$row['Naam']}</td> <td><input type='text' value='{$row['Naam']}' size='15'></td> <td><a href = 'update_leraar.php?id={$row['ID']}&Type=LeraarNaam&Naam={$row['Naam']}'>update</a></td></tr>";
                    }
                    break;

                case 'Vak':
                    $query = mysql_query("select * from vak", $DBconnect);
                    echo "<table id='t2' border='1'>";
                    echo "<tr id='trOut'><th id='thUp'>ID</th><th>Naam</th><th></th><th></th></tr>";
                    while ($row = mysql_fetch_array($query))
                    {
                        echo "<tr id='trIn'><td>{$row['ID']}</td><br/>";
                        echo "<td>{$row['Naam']}</td> <td><input type='text' size='10'></td> <td><a href = 'update_vak.php?id={$row['ID']}&Type=VakNaam&Naam={$row['Naam']}'>update</a></td></tr>";
                    }
                    break;

                case 'Locatie':
                    $query = mysql_query("select * from lokaal", $DBconnect);
                    echo "<table id='t3' border='1'>";
                    echo "<tr id='trOut'><th id='thUp'>ID</th><th></th><th>Nummer</th><th></th><th></th><th>Functie</th><th></th></tr>";
                    while ($row = mysql_fetch_array($query))
                    {
                        echo "<tr id='trIn'><td>{$row['ID']}</td><br/>";
                        echo "<td>{$row['Nummer']}</td> <td><input type='text' size='10'></td> <td><a href = 'update_locatie.php?id={$row['ID']}&Type=LocatieNummer&Nummer={$row['Nummer']}'>update</a></td><br/>";
                        echo "<td>{$row['Functie']}</td> <td><textarea rows='1' cols='10'></textarea></td> <td><a href = 'update_locatie.php?id={$row['ID']}&Type=LocatieFunctie&Functie={$row['Functie']}'>update</a></td></tr>";
                    }
                    echo "</table>";
                    break;

                case 'Qrcode':
                    $query = mysql_query("select * from QRCode", $DBconnect);
                    echo "<table id='t4' border='1'>";
                    echo "<tr id='trOut'><th id='thUp'>ID</th><th>Tekst</th><th></th><th></th></tr>";
                    while ($row = mysql_fetch_array($query))
                    {
                        echo "<tr id='trIn'><td>{$row['ID']}</td><br/>";
                        echo "<td>{$row['Tekst']}</td> <td><input type='text' size='10'></td> <td><a href = 'update_qrcode.php?id={$row['ID']}&Type=QrcodeTekst&Tekst={$row['Tekst']}'>update</a></td</tr>";
                    }
                    break;
            }
        }
        mysql_close();
        ?>

    </body>
</html>
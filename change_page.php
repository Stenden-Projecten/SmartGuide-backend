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

        if (isset($_POST['Naam']) && (isset($_POST['update'])||isset($_POST['remove'])||isset($_POST['add'])))
        {
            switch ($_GET['type']) 
            {
                    case 'leraar':
                        if (isset($_POST['update'])) 
                        {
                            $Naam = $_POST['Naam'];
                            $ID = $_GET['ID'];
                            $query = "UPDATE leraar SET Naam='$Naam' WHERE ID = '$ID'";
                            mysql_query($query) OR DIE(mysql_error());
                            echo "De tabel is geupdated";
                        }
                        if (isset($_POST['add'])) 
                        {
                            $Naam = $_POST['Naam'];
                            echo $Naam;
                            $query = "INSERT INTO leraar VALUES(Null,'$Naam')";//INSERT INTO `leraar`(`ID`, `Naam`) VALUES ([value-1],[value-2])
                            mysql_query($query) OR DIE(mysql_error());
                            echo "De tabel is gedingest";
                        }
                        if (isset($_POST['remove'])) 
                        {
                            $Naam = $_POST['Naam'];
                            $ID = $_GET['ID'];
                            $query = "DELETE FROM leraren WHERE Leraar = '$ID'";
                            $query2 = "DELETE FROM leraar WHERE Naam = '$Naam'";
                            $query3 = "DELETE FROM vakken WHERE Leraar = '$ID'";
                            mysql_query($query) OR DIE(mysql_error());
                            mysql_query($query3) OR DIE(mysql_error());
                            mysql_query($query2) OR DIE(mysql_error());
                            echo "Deze ding is helemaal mooi";
                        }

                    break;

                    case 'vak':
                        if (isset($_POST['update'])) 
                        {
                            $Naam = $_POST['Naam'];
                            $ID = $_GET['ID'];
                            $query = "UPDATE vak SET Naam='$Naam' WHERE ID = '$ID'";
                            mysql_query($query) OR DIE(mysql_error());
                            echo "De tabel is geupdated";
                        }
                        if (isset($_POST['add'])) 
                        {
                            $Naam = $_POST['Naam'];
                            echo $Naam;
                            $query = "INSERT INTO vak VALUES(Null,'$Naam')";//INSERT INTO `leraar`(`ID`, `Naam`) VALUES ([value-1],[value-2])
                            mysql_query($query) OR DIE(mysql_error());
                            echo "De tabel is gedingest";
                        }
                        if (isset($_POST['remove'])) 
                        {
                            $Naam = $_POST['Naam'];
                            $ID = $_GET['ID'];
                            $query = "DELETE FROM vakken WHERE Vak = '$ID'";
                            $query2 = "DELETE FROM vak WHERE Naam = '$Naam'";
                            mysql_query($query) OR DIE(mysql_error());
                            mysql_query($query2) OR DIE(mysql_error());
                            echo "Deze ding is helemaal mooi";
                        }
                    break;

                    case 'locatie':
                        if (isset($_POST['update'])) 
                        {
                            //Nummer
                            //functie
                            $Naam = $_POST['Naam'];
                            $Nummer = $_POST['Nummer'];
                            $ID = $_GET['ID'];
                            $query = "UPDATE lokaal SET Functie='$Naam' , Nummer = '$Nummer' WHERE ID = '$ID'";
                            mysql_query($query) OR DIE(mysql_error());
                            echo "De tabel is geupdated";
                        }
                        if (isset($_POST['add'])) 
                        {
                            $Naam = $_POST['Nummer'];
                            $Nummer = $_POST['Naam'];
                            echo $Naam;
                            $query = "INSERT INTO lokaal VALUES(Null,'$Naam','$Nummer')";//INSERT INTO `leraar`(`ID`, `Naam`) VALUES ([value-1],[value-2])
                            mysql_query($query) OR DIE(mysql_error());
                            echo "De tabel is gedingest";
                        }
                        if (isset($_POST['remove'])) 
                        {
                            $Naam = $_POST['Naam'];
                            $ID = $_GET['ID'];
                            $query = "DELETE FROM lokaal WHERE ID = '$ID'";
                            //$query2 = "DELETE FROM lokalen WHERE QRCode = '$ID'";
                            mysql_query($query) OR DIE(mysql_error());
                            //mysql_query($query2) OR DIE(mysql_error());
                            echo "Deze ding is helemaal mooi";
                        }
                    break;

                    case 'qrcode':
                        if (isset($_POST['update'])) 
                        {
                            $Naam = $_POST['Naam'];
                            $ID = $_GET['ID'];
                            //echo $Naam . $ID;
                            $query = "UPDATE qrcode SET Tekst ='$Naam' WHERE ID = '$ID'";
                            mysql_query($query) OR DIE(mysql_error());
                            echo "De tabel is geupdated";
                        }
                        if (isset($_POST['add'])) 
                        {
                            $Naam = $_POST['Naam'];
                            echo $Naam;
                            $query = "INSERT INTO qrcode VALUES(Null,'$Naam')";//INSERT INTO `leraar`(`ID`, `Naam`) VALUES ([value-1],[value-2])
                            mysql_query($query) OR DIE(mysql_error());
                            echo "De tabel is gedingest";
                        }
                        if (isset($_POST['remove'])) 
                        {
                            $Naam = $_POST['Naam'];
                            $ID = $_GET['ID'];
                            $query = "DELETE FROM qrcode WHERE ID = '$ID'";
                            $query2 = "DELETE FROM lokalen WHERE QRCode = '$ID'";
                            mysql_query($query) OR DIE(mysql_error());
                            mysql_query($query2) OR DIE(mysql_error());
                            echo "Deze ding is helemaal mooi";
                        }
                    break;
                
                default:
                    echo "get rekt";
                    break;
            }
        }
        if (isset($_POST['display']))
        {
            switch ($_POST['display'])
            {
                case 'Leraar':
                    $query = mysql_query("select * from leraar", $DBconnect);
                    echo "<table id='t1' border='1'>";
                    echo "<tr id='trOut'><th id='thUp'>ID</th><th>Naam</th><th></th></tr>";
                    while ($row = mysql_fetch_array($query))
                    {
                        echo "<form method='POST' action='?type=leraar&ID={$row['ID']}'>";
                        echo "<tr id='trIn'><td>{$row['ID']}</td>";
                        echo "<td>{$row['Naam']}</td><td>";
                        echo "<input type='text' value='{$row['Naam']}' name='Naam' size='15'></td>";

                        echo "<td><input type ='submit' name = 'update' value = 'update'></td>";
                        echo "<td><input type ='submit' name = 'remove' value = 'remove'></td></tr>";
                        echo "</form>";
                    }
                    echo "<form method='POST' action='?type=leraar'>";
                    echo "<td></td><td></td><td><input type='text' value='Nieuwe waardes hier' name='Naam' size='15'></td>";
                    echo "<td><input type ='submit' name = 'add' value = 'add'></td>";
                    echo "</form>";
                    break;

                case 'Vak':
                    $query = mysql_query("select * from vak", $DBconnect);
                    echo "<table id='t2' border='1'>";
                    echo "<tr id='trOut'><th id='thUp'>ID</th><th>Naam</th><th></th></tr>";
                    while ($row = mysql_fetch_array($query))
                    {
                        echo "<form method='POST' action='?type=vak&ID={$row['ID']}'>";
                        echo "<tr id='trIn'><td>{$row['ID']}</td>";
                        echo "<td>{$row['Naam']}</td>";
                        echo "<td><input type='text' value='{$row['Naam']}' name='Naam' size='20'></td>";

                        echo "<td><input type ='submit' name = 'update' value = 'update'></td>";
                        echo "<td><input type ='submit' name = 'remove' value = 'remove'></td></tr>";
                        echo "</form>";
                    }
                    echo "<form method='POST' action='?type=vak'>";
                    echo "<td></td><td></td><td><input type='text' value='Nieuwe waardes hier' name='Naam' size='15'></td>";
                    echo "<td><input type ='submit' name = 'add' value = 'add'></td>";
                    echo "</form>";
                    break;

                case 'Locatie':
                    $query = mysql_query("select * from lokaal", $DBconnect);
                    
                    echo "<table id='t3' border='1'>";
                    echo "<tr id='trOut'><th id='thUp'>ID</th><th></th><th>Nummer</th><th></th><th>Functie</th></tr>";
                    while ($row = mysql_fetch_array($query))
                    {
                        echo "<form method='POST' action='?type=locatie&ID={$row['ID']}'>";
                        echo "<tr id='trIn'><td>{$row['ID']}</td>";


                        echo "<td>{$row['Nummer']}</td>"; 
                        echo "<td><input type='text' value='{$row['Nummer']}' name='Nummer' size='10'></td>";
                        echo "<td>{$row['Functie']}</td><td><textarea rows='1' cols='10' value='' name='Naam'>{$row['Functie']}</textarea></td>";
                        echo "<td><input type ='submit' name = 'update' value = 'update'></td>"; 
                        echo "<td><input type ='submit' name = 'remove' value = 'remove'></td></tr>";

                        echo "</form>";
                    }
                    echo "<form method='POST' action='?type=locatie'>";
                    echo "<td></td><td><input type='text' value='Lokaal hier' name='Nummer'></td><td><input type='text' value='Nieuwe waardes hier' name='Naam' size='15'></td>";
                    echo "<td><input type ='submit' name = 'add' value = 'add'></td>";
                    echo "</form>";
                    echo "</table>";
                    break;

                case 'Qrcode':
                    $query = mysql_query("select * from QRCode", $DBconnect);
                    echo "<table id='t4' border='1'>";
                    echo "<tr id='trOut'><th id='thUp'>ID</th><th>Tekst</th><th></th></tr>";
                    while ($row = mysql_fetch_array($query))
                    {
                        echo "<form method='POST' action='?type=qrcode&ID={$row['ID']}'>";
                        echo "<tr id='trIn'><td>{$row['ID']}</td>";

                        echo "<td>{$row['Tekst']}</td>";
                        echo "<td><input type='text' name='Naam' size='20'></td>";
                        echo "<td><input type ='submit' name = 'update' value = 'update'></td>";
                        echo "<td><input type ='submit' name = 'remove' value = 'remove'></td></tr>";
                        echo "</form>";
                    }
                    echo "<form method='POST' action='?type=qrcode'>";
                    echo "<td></td><td></td><td><input type='text' value='Nieuwe waardes hier' name='Naam' size='15'></td>";
                    echo "<td><input type ='submit' name = 'add' value = 'add'></td>";
                    echo "</form>";
                    break;
            }
        }
        mysql_close();
        ?>

    </body>
</html>
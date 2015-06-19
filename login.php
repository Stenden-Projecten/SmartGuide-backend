<?php require_once(__DIR__ . "/db_config.php"); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>login</title>
        <!-- opmaak link naar .css voor de php site -->
        <link href='opmaak.css' rel='stylesheet'>
    </head>
    <body>
        <!-- div's en menu indeling met verwijzing naar de verscheidene php pages -->
        <div id='menu'>
            <ul>
                <li>
                    <a href="login.php">log in</a>
                </li>
                <li>
                    <a href="logout_page.php">log out</a>
                </li>
                <li>
                    <a href="change_db_page.php">Work on database</a>
                </li>
            </ul>
        </div>

        <?php
        session_start();
        //session starten en connectie met smartguide database gaan maken, als database niet gevonden is dan komt een error

        if (isset($_POST['send']))
        {

            if (empty($_POST['naam']) && empty($_POST['pass']))
            {
                $berichtje = "Je moet alle velden invullen";
                echo "<div id='berichtje'> " . $berichtje . "</div>";
            } else
            {
                $naam = mysql_escape_string($_POST['naam']);
                $pass = mysql_escape_string($_POST['pass']);

                //database connectie maken   
                $DBconnect = @mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD) OR DIE("unable to connect");
                $dbMessage = "could not find database: ";
                $db = mysql_select_db(DB_DATABASE, $DBconnect) OR DIE("<div id='berichtje'> " . $dbMessage . mysql_error() . "</div>");

                //hash het wachtwoord                
                $pass = hash("md5", $_POST["pass"]);

                //check of de waardes in database staan
                $sql = "SELECT * FROM login WHERE naam='$naam' and pass='$pass'";
                $result = mysql_query($sql, $DBconnect) OR DIE("query mislukt");
                $count = mysql_num_rows($result);

                //geef een berichtje met de naam van de ingelogde persoon
                if ($count == 1)
                {
                    $_SESSION['naam'] = $naam;
                    $berichtje = "Hallo " . ($_SESSION['naam']) . " ! ";
                    echo "<div id='berichtje'> " . $berichtje . "</div>";
                } else
                {
                    echo "<div id='berichtje2'> " . "Er is een verkeerde gebruikersnaam of wachtwoord ingevuld..." . "</div>";
                }
                mysql_close();
            }
        }
        ?>

        <!-- de form voor het aanpassen van de velden, gegevens worden uit change_page.php gehaald -->

        <div class='form'>
            <form method="post" action="login.php">
                <table>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input type="text" style="padding-left: 5px;" name="naam" placeholder="Gebruikersnaam" id="gebruiker"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input type="password" style="padding-left: 5px;" name="pass" placeholder="Wachtwoord" id="wachtwoord"/> 
                            <input type="submit" value="inloggen" name="send" id="submit"/>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>
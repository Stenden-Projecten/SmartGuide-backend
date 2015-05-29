<!DOCTYPE>
<html>
    <head>
        <title>login</title>
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
            </ul>
        </div>

        <?php
        session_start();
        if (isset($_POST['send']))
        {
            $naam = $_POST['naam'];
            $pass = $_POST['pass'];

            if (empty($_POST['naam']) && empty($_POST['pass']))
            {
                echo "Je moet alle velden invullen";
            } else
            {
                //database connectie maken   
                $DBconnect = mysql_connect("localhost", "root", "") OR DIE("unable to connect");
                mysql_select_db("Login", $DBconnect) OR DIE("could not find database: " . mysql_error());

                //hash het wachtwoord                
                $pass = hash("md5",$_POST["pass"]);
                
                // check of ze in database staan
                $sql = "SELECT * FROM users WHERE naam='$naam' and pass='$pass'";
                $result = mysql_query($sql, $DBconnect) OR DIE("query mislukt");
                $count = mysql_num_rows($result);

                if ($count == 1)
                {
                    $_SESSION['naam'] = $naam;
                    //$_SESSION['pass'] = $pass;
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
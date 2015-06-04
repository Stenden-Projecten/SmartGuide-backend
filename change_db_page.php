<!DOCTYPE>

<html>
    <head>
        <title>addMessage</title>
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
                    <a href="change_db_page.php">Select table</a>
                </li>
            </ul>
        </div>

        <?php
        session_start();
        if (!isset($_SESSION['naam']))
        {
            header('location: login.php');
            exit;
        }
        ?>

        <div class="form">
            <form method="post" action="change_page.php">
                <table>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input type="submit" value="Leraar" name="display" id="submit"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input type="submit" value="Vak" name="display" id="submit"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input type="submit" value="Locatie" name="display" id="submit"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input type="submit" value="Qrcode" name="display" id="submit"/>
                        </td>
                    </tr>
                </table>            
            </form>
        </div>

    </body>
</html>
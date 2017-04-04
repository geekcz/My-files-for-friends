<?php
ob_start();
session_start();
include 'pripojeni.php';
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>
        </title>
        <link rel="stylesheet" href="../CSS/css.css">
        <link rel="shortcut icon" href="../foto/favicon.bmp" type="image/x-icon">
    </head>
    <body>
        <div class="barva">
            <?php
            include 'menu.php';
            ?>
            <article>
                <div class="formprihlaseni">

                    <?php
                    if (isset($_POST["email"])) {
                        if ($_POST["email"] == "") {
                            echo "<div class='hlasky'>Zadej svůj E-mail!</div>";
                        } else if ($_POST["heslo"] == "") {
                            echo "<div class='hlasky'>Zadej své heslo!</div>";
                        } else {
                            $dotaz = "SELECT id, email, heslo, prava, potvrzeni_pristupu from uzivatele where email='{$_POST["email"]}' limit 1";
                            $data = mysqli_query($connect, $dotaz);
                            $zaznam = mysqli_fetch_array($data);
                            if ($zaznam["heslo"] == md5($_POST["heslo"])) {
                                
                                if ($zaznam["potvrzeni_pristupu"] == "0") {
                                    header("Location: zatimneprijat.php");
                                } else {
                                    $_SESSION["email"] = $zaznam["email"];
                                    $_SESSION["prava"] = $zaznam["prava"];
                                    $_SESSION["id"] = $zaznam["id"];
                                    $_SESSION["potvrzeni_pristupu"] = $zaznam["potvrzeni_pristupu"];
                                    //echo"uzivatel {$_SESSION["email"]} prihlasen";
                                    header("Location: uzivatel.php");
                                }
                            } else {
                                echo"<div class='hlasky'>Zadaný nesprávný E-mail nebo heslo!</div>";
                            }
                        }
                    }
                    if (!isset($_SESSION["email"])) {
                        ?>


                        <form method="post">
                            <label>E-mail:
                            </label>
                            <input type="text" name="email">
                            <label>Heslo:
                            </label>
                            <input type="password" name="heslo">
                            <input type="submit" value="Přihlásit">
                        </form>
                    </div>
                    <?php
                }
                ?>
            </article>
            <footer>
            </footer>
        </div>
    </body>
</html>

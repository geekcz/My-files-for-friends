<?php
session_start();
include 'pripojeni.php';
if(!(isset($_SESSION["email"]))){
    header("Location: index.php");
    exit;
}
if($_SESSION["prava"]=='0') {
    header("Location: nemasopravneni.php");
    exit;
}
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="../CSS/css.css">
        <link rel="shortcut icon" href="../foto/favicon.bmp" type="image/x-icon">
    </head>

    <?php
    if (!isset($_GET["id"])) {
        echo "neni zadano id";
        exit;
    }

    $data = mysqli_query($connect, "select uzivatele.id as uzivatel_id, uzivatele.jmeno, uzivatele.prijmeni, uzivatele.datum, uzivatele.vyska, uzivatele.email, uzivatele.tel, uzivatele.pohlavi, uzivatele.narodnost_id, uzivatele.info, narodnosti.id as narodnost_id, narodnosti.nazev as narodnost_nazev from uzivatele LEFT JOIN narodnosti ON uzivatele.narodnost_id=narodnosti.id where uzivatele.id='{$_GET["id"]}'");
    $lide = mysqli_fetch_array($data);
    ?>

    <body>
        <?php
        include 'menu.php';
        ?>
        <div class="barva">
            <article>

                <?php
                if (isset($_POST['check'])) {
//UPDATE `fitness`.`uzivatele` SET `jmeno` = '', `prijmeni` = '', `datum` = '', `vyska` = '', `email` = '', `heslo` = '', `tel` = '', `pohlavi` = '', `narodnost_id` = '', `info` = '', `prava` = '', `potvrzeni_pristupu` = '' WHERE `uzivatele`.`id` = 10;
                    if ($_POST['jmeno'] != "" && $_POST['prijmeni'] != "") {
                        $dotaz = "update uzivatele set jmeno='{$_POST['jmeno']}', prijmeni='{$_POST['prijmeni']}', vyska='{$_POST['vyska']}', datum='{$_POST['datum']}', email='{$_POST['email']}', tel='{$_POST['tel']}', info='{$_POST['info']}' where uzivatele.id = {$_GET['id']}";
                        $vypis = mysqli_query($connect, $dotaz);
                        if (!$vypis) {
                            echo mysqli_error($connect);
                        }
                        header("Location:sprava-uzivatelu.php");
                    } else {
                        echo"Vyplň data!";
                    }
                }
                ?>
                <a href="sprava-uzivatelu.php" class="uzivatelodkazy">Zpět</a> <br>
                <div class="editacetabulka">
                    <form action="edit.php?id=<?php echo $_GET['id']; ?>" method="post">

                        <label>Jméno:</label>
                        <input type="text" name="jmeno" value="<?php echo $lide['jmeno']; ?>"><br>
                        <label>Příjmení:</label>
                        <input type="text" name="prijmeni" value="<?php echo $lide['prijmeni']; ?>"><br>

                        <label>Výška:</label>
                        <input type="number" name="vyska" step="0.01" value="<?php echo $lide['vyska']; ?>"><br>

                        <label>Datum narození:</label>
                        <input type="date" name="datum" value="<?php echo $lide['datum']; ?>"><br>

                        <label>E-mail:</label>
                        <input type="email" name="email" value="<?php echo $lide['email']; ?>"><br>

                        <label>Telefoní číslo:</label>
                        <input type="text" name="tel" value="<?php echo $lide['tel']; ?>"><br>

                        <textarea name="info" rows="5" cols="50"><?php echo $lide['info']; ?></textarea><br>
                        <input type="hidden" name="check">
                        <input type="submit" value="Upravit">
                    </form>
                </div>
            </article>
            <footer></footer>
        </div>
    </body>
</html>

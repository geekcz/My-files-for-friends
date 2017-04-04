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

    </head>
    <body>
        <div class="barva">
            <?php
            include 'menu.php';
            include 'fce.php';
            ?>
            <article>
                
                <?php
                if ($_SESSION["prava"] == 1) {
                    echo "<a href='uzivatel.php' class='uzivatelodkazy'>Zpět</a>";
                    echo "<a href='sprava-uzivatelu.php' class='uzivatelodkazy'>Správa uživatelů</a>";
                }
                echo "<h1>Přijetí žádostí</h1>";
                echo "<div class='formprijeti'><table class='formprijeti'>
   <tr>
     <th>Jméno</th>
     <th>Přjmení</th>
     <th>Datum narození</th>
     <th>E-mail</th>
     <th>Telefoní číslo</th>
     <th>Pohlaví</th>
     <th>Národnost</th>
     <th>Info o sobě</th>
     <th>Potvrzení</th>
	 <th>Smazání</th>
   </tr>";
                $data = mysqli_query($connect, "select uzivatele.id as uzivatel_id, uzivatele.jmeno, uzivatele.prijmeni, uzivatele.datum, uzivatele.vyska, uzivatele.email, uzivatele.tel, uzivatele.pohlavi, uzivatele.narodnost_id, uzivatele.info, narodnosti.id as narodnost_id, narodnosti.nazev as narodnost_nazev from uzivatele LEFT JOIN narodnosti ON uzivatele.narodnost_id=narodnosti.id where potvrzeni_pristupu='0' order by uzivatele.id");
                while ($zaznam = mysqli_fetch_array($data)) {
                    if ($zaznam['pohlavi'] == 1) {
                        $pohlavi = 'muž';
                    } else {
                        $pohlavi = 'žena';
                    }
                    $informace = zkratitText($zaznam["info"], 30);
                    echo "   <tr>
     <td>{$zaznam["jmeno"]}</td>
     <td>{$zaznam["prijmeni"]}</td>
     <td>{$zaznam["datum"]}</td>
     <td>{$zaznam["email"]}</td>
     <td>{$zaznam["tel"]}</td>
     <td>$pohlavi</td>
     <td>{$zaznam["narodnost_nazev"]}</td>
     <td title='{$zaznam['info']}'>$informace</td>
     <td><a href='potvrzeni.php?id={$zaznam["uzivatel_id"]}' class='prijetiodkazy'>Přijmout</a></td>
	 <td><a href='odmitnuti.php?id={$zaznam["uzivatel_id"]}' class='spravaodmitnutiodkazy'>Smazat</a></td>

   </tr>";
                }
                if (isset($_POST["prijmout"])) {
                    $update = "UPDATE `uzivatele` SET `potvrzeni_pristupu` = '1' WHERE `uzivatele`.`id` = {$zaznam["id"]}";
                    $dotaz_update = mysqli_query($connect, $update);
                }
                echo "</table></div>";
                ?>

                
                
            </article>
            <footer>
            </footer>
        </div>
    </body>
</html>

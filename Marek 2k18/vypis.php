<!doctype html>
<html>
  <head>
    <title>Příklady PHP</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="ukazky.css">
     <script type="text/javascript"></script>  
  </head>
  <body>
    <div>
    <?php
    include "spojeni.php";
    $dotaz=$spojeni->prepare("SELECT nausnice.nazev, nausnice.velikost, nausnice.barvajedna, nausnice.barvadva, nausnice.cena FROM nausnice");
    $dotaz->bind_result($nazev,$velikost,$barvajedna,$barvadva,$cena);
    $dotaz->execute();
    echo "<table>";
    echo "<tr><th>Název</th><th>Cena</th><th>barva 1</th><th>barva 2</th><th>Velikost</th></tr>\n";
    while($dotaz->fetch()){
      echo "<tr><td>$nazev</td><td>$cena</td><td>$barvajedna</td><td>$barvadva</td><td>$velikost</td></tr>\n";
    }
    echo "</table>";
    $dotaz->close();
    ?>
  </div>
  </body>
</html>

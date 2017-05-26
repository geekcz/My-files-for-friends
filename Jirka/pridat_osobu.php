<?php

include ('htmlHlavicka.html');
include ('pripojeni_k_DB.php');

echo '<h2>Přidání nové osoby</h2>';
echo '<h3>(adresa se vybírá ze seznamu vytvořených adres, nová adresa se zadává v menu <a href="seznam_adresy.php">Seznamy</a>)</h3>';
echo '<br />';

$seznam_adresy = "SELECT *".
                   " FROM adresy".
                   " ORDER BY mesto, ulice";
$vysledek_adresy = $db->query($seznam_adresy) OR die ('příkaz načtení seznamu adres se neprovedl: ' . mysql_error() );

$seznam_typkontakt = "SELECT * FROM typy_kontaktu ORDER BY 1";
$vysledek_typkontakt = $db->query($seznam_typkontakt) OR die ('příkaz načtení typů ontaktů se neprovedl: '.mysql_error() );

echo '<form action="zobraz_osoby.php" method="post">'; 
echo '   <input type="hidden" name="pridat_osobu" value="TRUE">';
echo '   <input type="hidden" name="pridat_kontakt" value="TRUE">';
echo '   <table class="formstyle">';
echo '   <tr>';
echo '      <td class="formtop2" >Základní údaje</td>';
echo '   </tr>'; 
echo '   <tr>';
echo '         <td class="formtop">příjmení</td>';
echo '         <td class="formtop">jméno</td>';
echo '         <td class="formtop">přezdívka</td>';
echo '         <td class="formtop">výška</td>';
echo '         <td class="formtop">datum narození</td>';
echo '         <td class="formtop">adresa</td>';
echo '   </tr>';
echo '   <tr>';
echo '         <td></td><td></td><td></td><td></td><td align="left">(rrrr-mm-dd)</td>';
echo '   </tr>';
echo '   <tr>';
echo '   </tr>';
echo '   <tr>';
echo '         <td align="left"><input type="text" name="prijmeni" size="15" maxlength="50"></td>';
echo '         <td align="left"><input type="text" name="jmeno" size="10" maxlength="50"></td>';
echo '         <td align="left"><input type="text" name="prezdivka" size="10" maxlength="50"></td>';
echo '         <td align="left"><input type="text" name="vyska" size="3" maxlength="3"></td>';
echo '         <td align="left"><input type="text" name="datum_narozeni" size="10" maxlength="10"></td>';

                   $adr = ""; // žádná adresa
echo '         <td align="left">';
echo '              <select name="cislo_adresy" size="1">';
echo '                   <option value="0">'.$adr.'</option>';   // 1. položka rozbalovacího seznamu je prázdná adresa
                         while ($radek_adresa=$vysledek_adresy->fetch_object())  // další adresy se do rozbalovacího seznamu načtou z tabulky adresy
                             { $adr = $radek_adresa->mesto.', '.$radek_adresa->ulice.' '.$radek_adresa->cislo_domu.', '.$radek_adresa->psc;
                               echo '<option value="'.$radek_adresa->id_adresy.'">'.$adr.'</option>';
                             }
echo '              </select>';
echo '         </td>';
echo '   </tr>';

echo '   <tr>';
echo '      <td class="formtop2" >Kontakt</td>';
echo '   </tr>';
echo '   <tr>';
echo '         <td class="formtop">typ kontaktu</td>';
echo '         <td class="formtop">kontakt</td>';
echo '   </tr>';
echo '   <tr>';
echo '   </tr>';
echo '   <tr>';
                   $kontakt = ""; // žádná adresa
echo '         <td>';
echo '              <select name="cislo_p_kontaktu" size="1">';
echo '                   <option value="0">'.$kontakt.'</option>';   // 1. položka rozbalovacího seznamu je prázdná adresa

                         $i = 1;
                         while ($radek_kontakt=$vysledek_typkontakt->fetch_object())  // další adresy se do rozbalovacího seznamu načtou z tabulky adresy
                             { $kontakt = $radek_kontakt->nazev;
                               echo '<option value="'.$i.'">'.$kontakt.'</option>'; //echo '<option value="'.$radek_kontakt->id_typy_vztahu.'">'.$kontakt.'</option>';
                               $i++;
                             }
echo '              </select>';
echo '         </td>';
echo '         <td align="left"><input type="text" name="nazev_p_kontaktu" size="15" maxlength="50"></td>';
echo '   </tr>'; 
echo '   <tr >';
echo '         <td align="center" colspan="6"><input type="submit" name="odeslat" value="uložit"></td>';
echo '   </tr>';


/* KONEC PŘIDÁNÍ */

echo '   </table>';
echo '</form>';  

?>


</body>

</html>
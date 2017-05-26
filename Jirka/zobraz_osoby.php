<?php

include ('htmlHlavicka.html');
include ('pripojeni_k_DB.php');


echo '<h2>Zobrazení údajů o osobách</h2>';
echo '<br />';

if (isset($_POST['pridat_osobu']))
  { $prijmeni = $_POST['prijmeni'];
    $jmeno = $_POST['jmeno'];
    $prezdivka = $_POST['prezdivka'];
    $datum_narozeni = $_POST['datum_narozeni'];
    $vyska = $_POST['vyska'];
    $cislo_adresy = $_POST['cislo_adresy'];
    if (!(empty($prijmeni) || (empty($jmeno))))    // v případě prázdného příjmení nebo jména se vstup neuskuteční }
      { if ($vyska==0)  // není-li výška zadána, nebude se do položky výška nic ukládat, chtělo by to ještě obdobně ošetřit pro nezadané datum, aby se nevkládalo 0000-00-00     
           $vstup_osoby = "INSERT INTO osoby (prijmeni, jmeno, prezdivka, datum_narozeni, id_adresy) VALUES ('$prijmeni', '$jmeno', '$prezdivka', '$datum_narozeni', '$cislo_adresy')";
         else $vstup_osoby = "INSERT INTO osoby (prijmeni, jmeno, prezdivka, datum_narozeni, vyska, id_adresy) VALUES ('$prijmeni', '$jmeno', '$prezdivka', '$datum_narozeni', '$vyska', '$cislo_adresy')"; 
     //  echo $vstup_osoby; exit;
        // jinou možností je v případě nezadání výšky ve vstupu rozkouskovat znění dotazu v $vstup_osoby a místo vyska, a '$vyska', tam přiřetězit prázdný řetězec
        $db->query($vstup_osoby) OR die ('příkaz INSERT_1 se neprovedl:' );
      }
/*  }
  
/* PŘIDÁNO - PŘIDAT KONTAKT /

if (isset($_POST['pridat_kontakt']))  
        {    */
   
   
   /*   $ID_nove_osoby = "SELECT osoby.id_osoby FROM osoby WHERE prijmeni='$prijmeni' AND jmeno='$jmeno' AND datum_narozeni='$datum_narozeni'";
      $db->query($ID_nove_osoby) OR die ('příkaz zjištění ID se neprovedl: ' . mysql_error() );  */
   
   
            $zjisteni_idcka = $db -> prepare("SELECT osoby.id_osoby FROM osoby WHERE prijmeni='$prijmeni' AND jmeno='$jmeno' AND datum_narozeni='$datum_narozeni'");
            $zjisteni_idcka -> bind_result($osoba_id_zjisteni);
            $zjisteni_idcka -> execute();
            $zjisteni_idcka = $zjisteni_idcka->fetch();
              //  echo $osoba_id_zjisteni;
   
   
   
   
   
      $cislo_p_kontaktu=$_POST['cislo_p_kontaktu'];
      $nazev_p_kontaktu=$_POST['nazev_p_kontaktu'];
      $pridani_kontaktu = "INSERT INTO kontakty (id_osoby, id_typy_kontaktu, kontakt) VALUES ('$osoba_id_zjisteni', '$cislo_p_kontaktu', '$nazev_p_kontaktu')";
                         //" VALUES ('$vysledek_IDnosoby', '1', '775063142')";
      $db->query($pridani_kontaktu) OR die ('příkaz INSERT_2 se neprovedl: ' . mysql_error() );  
    // tohle jsem si zakomentoval, Jirka
   // break;
        }
/* KONEC PŘIDÁNÍ */

if (isset($_POST['opravit_udaje_osoby']))
  { $pamet_id_osoby=$_POST['pamet_id_osoby'];
    $IDadr=$_POST['cislo_vybrane_adresy'];
    $prijm=$_POST['prijm'];
    $jm=$_POST['jm'];
    $prezd=$_POST['prezd'];
    $datnar=$_POST['datnar'];
    $vys=$_POST['vys'];
    $oprav_osobu = "UPDATE osoby". 
                      " SET prijmeni='$prijm', jmeno='$jm', prezdivka='$prezd',".
                           " datum_narozeni='$datnar', vyska='$vys', id_adresy='$IDadr'".
                      " WHERE id_osoby='$pamet_id_osoby'";
    $db->query($oprav_osobu) OR die ('oprava údajů osoby se neprovedla: ' . mysql_error() );
  }
  
if (isset($_POST['Ano_zrusit_osobu']))
  { $pamet_id_osoby = $_POST['pamet_id_osoby'];

    $zrus_kontakty_osoby = "DELETE FROM kontakty".
                              " WHERE id_osoby='$pamet_id_osoby'";
    $db->query($zrus_kontakty_osoby) OR die ('příkaz zrušení kontaktů osoby se neprovedl: ' . mysql_error() ); 

    $zrus_vztahy_osoby = "DELETE FROM vztahy".
                              " WHERE id_osoby1='$pamet_id_osoby'".
                                 " OR id_osoby2='$pamet_id_osoby'";
    $db->query($zrus_vztahy_osoby) OR die ('příkaz zrušení vztahů osoby se neprovedl: ' . mysql_error() ); 

    $zrus_schuzky_osoby = "DELETE FROM osoby_schuzky".
                              " WHERE id_osoby='$pamet_id_osoby'";
    $db->query($zrus_schuzky_osoby) OR die ('příkaz zrušení schůzek osoby se neprovedl: ' . mysql_error() ); 

    $zrus_osobu = "DELETE FROM osoby".
                      " WHERE id_osoby='$pamet_id_osoby'";
    $db->query($zrus_osobu) OR die ('příkaz zrušení osoby se neprovedl: ' . mysql_error() ); 
  }

$detail_osoba = "SELECT *". 
                    " FROM osoby LEFT JOIN adresy ON osoby.id_adresy=adresy.id_adresy".
                    " ORDER BY prijmeni, jmeno";
$vysledek_osoba = $db->query($detail_osoba) OR die ('příkaz výběru osob se neprovedl: ' . mysql_error() ); 

echo '<table border="1"  class="tablestyle">';
echo '<tr><td class="tablehead">Více </td><td class="tablehead">Oprav</td><td class="tablehead">Zruš</td>'.
          '<td class="tablehead">příjmení</td>'.
          '<td class="tablehead">jméno</td>'.
          '<td class="tablehead">přezdívka</td>'.
          '<td class="tablehead">datum narození</td>'.
          '<td class="tablehead">výška</td>'.
          '<td class="tablehead">adresa</td>'.
      '</tr>';

while ($radek_osoba=$vysledek_osoba->fetch_object())
  { 
    if  (empty($radek_osoba->mesto) && empty($radek_osoba->ulice) 
         && empty($radek_osoba->cislo_domu) && empty($radek_osoba->psc))
         $adr = '';                            // bezdomovec
      else $adr = $radek_osoba->mesto.', '.$radek_osoba->ulice.' '.$radek_osoba->cislo_domu.', '.$radek_osoba->psc;

    echo '<tr>'.
              '<td class="tablepic"><a href="zobraz_osobu_detailne.php?id_osoby='.$radek_osoba->id_osoby.'"><img src="detaily.jpg"</a></td>'.
              '<td class="tablepic"><a href="oprava_udaju_osoby.php?id_osoby='.$radek_osoba->id_osoby.'"><img src="edit.jpg"</a></td>'.
              '<td class="tablepic"><a href="ruseni_osoby_s_overenim.php?id_osoby='.$radek_osoba->id_osoby.'"><img src="delete.jpg"</a></td>'.
              '<td align="left">'.$radek_osoba->prijmeni.'</td>'.
              '<td align="left">'.$radek_osoba->jmeno.'</td>'.
              '<td align="left">'.$radek_osoba->prezdivka.'</td>'.
              '<td align="left">'.$radek_osoba->datum_narozeni.'</td>'.
              '<td align="left">'.$radek_osoba->vyska.'</td>'.
              '<td align="left">'.$adr.'</td>'.
         '</tr>';
  }

echo '</table>';
echo '<br />';


?>


<!-- <a href="zobraz_osoby.php">Zpět</a>  návrat k zobrazení osob -->
<!--  <a href="index.html">Domů</a>  návrat do menu -->
</div>

</body>

</html>
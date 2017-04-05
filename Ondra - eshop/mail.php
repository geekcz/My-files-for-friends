<?php
    $zakaznik = $_SESSION["email"];
    $cislo = time();


        
    $to      = $zakaznik;
    $subject = 'Objednávka č. '.$cislo;
    $message = 'Dobrý den,
    
    Právě jsme zaregistrovali vaši objednávku z internetového eshopu www.bosscan.ferovasit.cz.
    Objednali jste si produkt(y):';
        for($a=0; $a<count($_SESSION['kosik']); $a++){
              $sqli = "SELECT * FROM zbozi WHERE id={$_SESSION['kosik'][$a]};";
              $dat=mysqli_query($conn,$sqli);
              $zaz=mysqli_fetch_array($dat);
                $naz=$zaz['nazev'];
                $vyr=$zaz['vyrobce'];
                $pop=zkrat($zaz['popis']);
                $message .= $naz." ".$vyr." ".$pop.",";
                }
                
    $messages .= 's celkovou cenou '.$cena.', od '.$_SESSION['email'].'.';
    $headers = 'From: pardubice@bosscan.cz'  . "\r\n" .
                'BCC: ondrej.pulc@gmail.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();


    $odeslani = mail($to, $subject, $message, $headers);
    if(isset($odeslani) == true){
        $mail = $_SESSION["email"];
        $overeni = "INSERT INTO `objednavka` (`cislo`, `text`, `uzivatel`, `cena`) 
                                    VALUES ('$cislo', '$message', '$mail', '$cena');";
     $result = mysqli_query($conn, $overeni);
      
    } else {
            echo "Jejda :/ Při odesílání došlo k chybě.";
         }     
    
            

?>
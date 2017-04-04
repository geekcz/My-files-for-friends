<?php
session_start();
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="mp_css.css">
    <title></title>
</head>

<body>
    <div id="wrap">
        <div id="sliderwow">

            <div class="vlevo" onclick="leva()"></div>
            <div class="vpravo" onclick="prava()"></div>
            <div id="img_royal">
                <div class="head-logo">
                    <a href="index.php"><img src="image/royal.png" style=" margin-top:20px;height:100px; width:150px;"></a>
                </div>
                <div class="soc-logos">
                    <a href="https://www.facebook.com/RHPetrDachovsky/?fref=ts" target="_blank"><img src="image/logofb.png" style="height:30px; width:30px;"></a>
                </div>
                <div class="soc-logos1">
                    <a href="https://www.instagram.com/petr.dachovsky/" target="_blank"><img src="image/logoinsta.png" style="height:30px; width:30px; marin-left:100px;"></a>
                </div>
                <div class="soc-logos2">
                    <a href="https://plus.google.com/114638414263906239797" target="_blank"><img src="image/google.png" style="height:30px; width:30px; marin-left:100px;"></a>
                </div>
            </div>

        </div>
        <div id="header">
            <header>
                <?php
include 'menu.php';
    ?>

            </header>
        </div>
        <div id="article">
            <article>
                <p style="font-size:1.7em; text-align:center; color:#CC9933; ">KDE NÁS NAJDETE?</p>
                <div class="kontakt">
                    

                    <div id="mapa">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d633.364869873802!2d15.725942729241776!3d50.020715360387676!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x470c34ab1f888227%3A0x9e01d053cad5f521!2sPra%C5%BEsk%C3%A1+148%2C+530+06+Pardubice+VI!5e1!3m2!1scs!2scz!4v1484415137296" width="100%" height="500" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
<div class="section group">
    <div class="col span_2_of_4">
   
                    <div class="k-kontakt1">
                        <h2 class="k-h2">Kontaktujte nás</h2>
                        <img src="image/address.png" style="margin-right:10px;"> Adresa: Pražská 148 53006 Pardubice VI <br>
                        <img src="image/phone.png" style="margin-right:10px;"> Telefon: 776753979<br>
                        <img src="image/mail.png" style="margin-right:10px;"> Email: Petrdachov@seznam.cz<br>

                        <h3 style="color:#CC9933;"> Socialní sítě</h3>
                        <div class="soc-logo">
                            <a href="https://www.facebook.com/RHPetrDachovsky/?fref=ts" target="_blank"><img src="image/logofb.png" style="height:35px; width:35px;"></a>
                        </div>
                        <div class="soc-logo">
                            <a href="https://www.instagram.com/petr.dachovsky/" target="_blank"><img src="image/logoinsta.png" style="height:35px; width:35px; marin-left:100px;"></a>
                        </div>
                        <div class="soc-logo">
                            <a href="https://plus.google.com/114638414263906239797" target="_blank"><img src="image/google.png" style="height:35px; width:35px; marin-left:100px;"></a>
                        </div>
                    </div>
         </div>
    <div class="col span_2_of_4">
                    <div class="k-kontakt2">
                        <h2 class="k-h2">Otevirací doba</h2>
                        PONDĚLI-PÁTEK 8:00 -18:00<br> SOBOTA-NEDĚLE ZAVŘENO<br>
                        <p>Prosíme zákazníky, aby se dostavili na službu do našeho vlasovém salonu včas. Při příchodu na ošetření o 10 a více minut později nemůžeme poskytnutí služeb garantovat. Děkujeme za pochopení.</p>
                    </div>
                </div>
    </div>
                </div>
                
                <?php
                if(isset($_SESSION["email"])){
                    
                    ?>
  
                    <form method="post">   
                        <select name="email_kadernika">
                    <?php 
                    include 'pripojeni.php';
                    $nacteni_kaderniku = "SELECT email FROM kadernici ORDER BY jmeno ASC";
                    $emaily_kaderniku = mysqli_query($spojeni, $nacteni_kaderniku);
                    while($kadernik_zaznam = mysqli_fetch_array($emaily_kaderniku)){
                        echo "<option value='{$kadernik_zaznam["email"]}'>{$kadernik_zaznam["email"]}</option>";
                    }          
                    ?>  
                    </select>
                        <input type="text" name="jmeno" placeholder="jmeno">
                        <input type="text" name="prijmeni" placeholder="prijmeni">
                        <input type="date" name="datum">
                        <textarea name="zprava" placeholder="napiste zpravu"></textarea>
                        <input type="submit" value="Odeslat">
                    </form>
                    <?php
                    if (isset($_POST["zprava"])) {
                        if ($_POST["jmeno"] == "") {
                            echo "vypln";
                        } else {
                            $kontaktovani_kadernika = $_POST["email_kadernika"];
                            
                            $udaje_jmeno = $_POST["jmeno"];
                            $udaje_prijmeni = $_POST["prijmeni"];
                            $udaje_datum = $_POST["datum"];
                            $udaje_zprava = $_POST["zprava"];
                        
                            $prihlaseny_email = $_SESSION['email'];
                            
                            
                            #!!!!!!!!!!!!!!!!!!!!! po odkomentovani radku $to = $kontaktovani_kadernika; a smazání řádku $to = 'info@ferovasit.cz'; se začnou maily odesílat kadeřníkům !!!!!!!!!!!!!!!!!!!!!
                            
                            // $to = $kontaktovani_kadernika;
                            $to = 'info@ferovasit.cz';
                            
                            
                            
                            $subject = 'můj předmět';
                            $message = 'Dobrý den. Před chvílí se k vám přihlásil '.$udaje_jmeno.' '.$udaje_prijmeni.'. Zadal(a) údaje: datum - '.$udaje_datum.' a zpráva -'.$udaje_zprava;
                            $message .= 'Přihlášeného můžete kontaktovat na emailu: '.$prihlaseny_email;
                            $headers = 'From: neodepisuj@fanda.ferovasit.cz' . "\r\n" .
                                    'X-Mailer: PHP/' . phpversion();
                            $odeslani = mail($to, $subject, $message, $headers);
                            if ($odeslani == false) {
                                echo "chyba";
                                exit;
                            }
                        }
                    }
                    
                    }
                    ?>
        
                
            </article>

        </div>
    <section class="partneri">
        <p style="font-size:1.7em; text-align: center; color:#CC9933; ">Partneři</p>
        <div class="section group">
            <div class="col span_1_of_4">
                <a href="http://previa.conceptczech.cz"><img  src="image/previa-logo.png"></a>
            </div>
            <div class="col span_1_of_4">
                <a href="http://www.conceptczech.cz/ph"><img  src="image/ph-logo.png"></a>
            </div>
            <div class="col span_1_of_4">
                <a href="http://previa.conceptczech.cz"><img  src="image/previa-logo.png"></a>
            </div>
            <div class="col span_1_of_4">
                <a href="http://www.conceptczech.cz/ph"><img  src="image/ph-logo.png"></a>
            </div>
        </div>

    </section>
<?php
        include 'footer.php';
        ?>
        </div>
    <script src="js.js" type="text/javascript"></script>
</body>

</html>

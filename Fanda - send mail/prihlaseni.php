<?php
ob_start();
include 'php/connect.php';
session_start();
$spatnyemail = false;
    $spatneheslo = false;
    
    if(isset($_POST['button'])){

    $dotaz=$pdo->prepare("
    SELECT * from uzivatele where email = :email  AND potvrzeni_pristupu = 1
    ");

    $dotaz->execute([
        "email"=>$_POST['email']
    ]);
    $vysledek=$dotaz->fetch();
    
    if(empty($vysledek)){    
        $spatnyemail=true;
    }else{
        $hash = md5($_POST['password']);
        if($hash==$vysledek['heslo']){
            $_SESSION['uzivatelID']=$vysledek['id'];
            $_SESSION['email']=$vysledek['email'];
            $_SESSION['admin']=$vysledek['admin'];
            header("Location: index.php");
        }else{
            $spatneheslo = true;
        }    
    }

    }

?>
    <!doctype html>
    <html>

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="mp_css.css">
        <title></title>
        <script>
            function kontrola() {
                var zprava = "";
                var reg;

                reg = new RegExp("^[A-ZŽČČŘĎŤŇŠ]+\.[a-zščřďťňéíáýůú]+$");
                if (!reg.test(document.getElementsByName("jmeno")[0].value)) {
                    zprava += "Zadejte správné jméno";
                }
                reg = new RegExp("^[A-ZŽČČŘĎŤŇŠ]+\.[a-zščřďťňéíáýůú]+$");
                if (!reg.test(document.getElementsByName("prijmeni")[0].value)) {
                    zprava += "Zadejte správné přijmení";
                }
                
                reg = new RegExp("^[0-9]{1,2}\.[0-9]{1,2}\.[0-9]{4}$");
                if (!reg.test(document.getElementsByName("datum_narozeni")[0].value)) {
                    zprava += "Zadejte správné datum narození podle předlohy";
                }


                if (document.getElementsByName("email")[0].checked == true) {
                    reg = new RegExp("^[A-Za-z\.a-z]+@[a-z0-9]+.[a-z]{2,5}$");
                    if (!reg.test(document.getElementsByName("mail")[0].value)) {
                        zprava += "\n Mail není ve správném tvaru";
                    }
                } else {
                    reg = new RegExp("^[0-9]{3}\.?[0-9]{3}\.?[0-9]{3}$");
                    if (!reg.test(document.getElementsByName("telefon")[0].value)) {
                        zprava += "\n Telefon není ve správném tvaru";
                    }
                }




                if (zprava == "") {
                    return true;
                } else {
                    alert(zprava);
                    return false;
                }
            }

        </script>
    </head>

    <body>
        <div id="wrap">
            <div id="sliderwow">

                <div class="vlevo" onclick="leva()"></div>
                <div class="vpravo" onclick="prava()"></div>
                <div id="img_royal">
                    <div class="head-logo">
                        <a href="index.php"><img src="image/royal.png" style="margin-top:20px;height:100px; width:150px;"></a>
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
                    <?php
    include 'pripojeni.php';
if(isset($_POST["jmeno"])) {
    
if($_POST["jmeno"]=="") {echo "<h3>Zadejte jmeno</h3>\n"; }
if ($_POST["prijmeni"]=="") {echo "<h3>Zadejte prijmeni</h3>\n";}
if ($_POST["password"]=="") {echo "<h3>Zadejte heslo</h3>\n";}
if ($_POST["datum_narozeni"]=="") {echo "<h3>Zadejte datum narozeni</h3>\n";}
if ($_POST["email"]=="") {echo "<h3>Zadejte email</h3>\n";}
if ($_POST["telefon"]=="") {echo "<h3>Zadejte telefon</h3>\n";}
    
else {
     $hash = md5($_POST["password"]);
    $dotaz=("insert into uzivatele (jmeno, prijmeni, heslo, email, datum_narozeni,telefon, pohlavi) value('{$_POST["jmeno"]}','{$_POST["prijmeni"]}','$hash','{$_POST["email"]}','{$_POST["datum_narozeni"]}','{$_POST["telefon"]}',
    '{$_POST["pohlavi"]}');");
    $result=mysqli_query($spojeni,$dotaz);
    if($result) {echo "<h1 style='color:green; text-align:center;'>Regisrace proběhla úspěšně</h1>\n";}
    else {echo "<h1 style='color:red; text-align:center;'>Neúspěšná registrace</h1>\n";}
  }
}      
  
?>


                        <form action="" method="post" class="main_form">
                            <fieldset id="testform">

                                <legend>PRIHLÁSIT SE</legend>
                                <div id="formContent1">
                                    <?php
    
    

    
if($spatnyemail){
?>
                                        <input type="text" class="name" name="email" placeholder="E-mail" required style="border-color:red;">
                                        <input type="password" class="password" name="password" placeholder="Heslo" required style="border-color:red;">
                                        <input type="submit" class="button" name="button" value="PRIHLASIT SE">
                                        <?php
}else if($spatneheslo){
    ?>
                                            <input type="text" class="name" name="email" placeholder="E-mail" required style="border-color:lime;">
                                            <input type="password" class="password" name="password" placeholder="Heslo" required style="border-color:red;">
                                            <input type="submit" class="button" name="button" value="PRIHLASIT SE">
                                            <?php
}else if($spatnyemail == false && $spatneheslo == true){
    echo "Byli jste přihlášeni jako {$vysledek['email']}.";
}else{
    ?>
                                                <input type="text" class="name" name="email" placeholder="E-mail" required>
                                                <input type="password" class="password" name="password" placeholder="Heslo" required>
                                                <input type="submit" class="button" name="button" value="PRIHLASIT SE">
                                                <?php
}
    
    ?>
                                </div>


                            </fieldset>

                        </form>




                        <form method="post" class="main_form" onsubmit='return kontrola()'>
                            <fieldset id="testform">
                                <legend>REGISTRACE</legend>
                                <div id="formContent2">
                                    <label>Jméno:</label><input style="margin-left:84px;" type="text" class="name" name="jmeno" placeholder="Jan" required=""><br>
                                    <label>Přijmení:</label><input style="margin-left:75px;" type="text" class="jmeno" name="prijmeni" placeholder="Novak" required=""><br>
                                    <label>Datum narození:</label><input style="" type="date" class="datum_narozeni" name="datum_narozeni"><br>
                                    <label>Pohlaví:</label><label style="margin-left:75px; margin-top:10px; margin-bottom:10px;">Zena</label><input type="radio" class="pohlavi" name="pohlavi" required="" value="0"><label>Muz</label><input type="radio" class="pohlavi" name="pohlavi" required="" value="1"><br>
                                    <label>Heslo:</label><input style="margin-left:92px;" type="password" class="password" name="password" placeholder="Heslo" required=""><br>
                                    <label>Heslo znovu:</label><input style="margin-left:39px;" type="password" class="password2" name="password2" placeholder="Heslo znovu" required=""> <br>
                                    <label>E-mail:</label><input style="margin-left:88px;" type="email" class="email" name="email" placeholder="Jannovak@seznam.cz" required=""><br>
                                    <label>Telefon:</label><input style="margin-left:78px;" type="text" class="telefon" name="telefon" placeholder="777 666 555" required=""><br>

                                    <div class="regbutton"><input type="submit" class="button2" name="button2" value="ZAREGISTROVAT SE"></div>
                                </div>
                            </fieldset>

                        </form>


                </article>
            </div>
            <section class="partneri">
                <p style="font-size:1.7em; text-align: center; color:#CC9933; ">Partneři</p>
                <div class="section group">
                    <div class="col span_1_of_4">
                        <a href="http://previa.conceptczech.cz"><img src="image/previa-logo.png"></a>
                    </div>
                    <div class="col span_1_of_4">
                        <a href="http://www.conceptczech.cz/ph"><img src="image/ph-logo.png"></a>
                    </div>
                    <div class="col span_1_of_4">
                        <a href="http://previa.conceptczech.cz"><img src="image/previa-logo.png"></a>
                    </div>
                    <div class="col span_1_of_4">
                        <a href="http://www.conceptczech.cz/ph"><img src="image/ph-logo.png"></a>
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
<?php
 ob_end_flush();
?>
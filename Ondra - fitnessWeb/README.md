1) pri prihlaseni: nepotvrzený uživatel se NYNÍ nemůže přihlásit (presmerovan na zatimneprijat.php); potvrzený je přihlášen (řádky 35 a dál, přesun podmínky)
2) opravneni: neadmin (bezny uzivatel) se nemuze dostat na stranky; neprihlaseny uzivatel se taky nemuze na tyto stranky dostat:
        odmitnuti.php
        prijeti.php
        sprava-uzivatelu.php
        potvrzeni.php
        edit.php
        
        uzivatel je presmerovan na nemasopravneni.php
        
        
        kod: 
        #pokud stranku prohlizi neprihlaseny uzivatel
            if(!(isset($_SESSION["email"]))){
                header("Location: index.php");
                exit;
            }
            #pokud uz je uzivatel prihlasen, resime jeho prava
            if($_SESSION["prava"]=='0') {
                header("Location: nemasopravneni.php");
                exit;
            }
            
3) co bys jeste mohl - doplnit title :)            
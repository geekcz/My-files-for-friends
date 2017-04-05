<?php  
if(!(isset($_SESSION["id"]))){
    header("Location: index.php");
    exit;
}

session_start();
include 'db.php';

                        $zjisti_heslo = "SELECT id, heslo FROM uzivatele WHERE uzivatele.id={$_SESSION['id']}";
                        $ziskej_heslo = mysqli_query($db_spojeni, $zjisti_heslo);
                        $vypis_heslo = mysqli_fetch_array($ziskej_heslo);

                    if(!isset($_POST['sending'])){
                            echo "
                                <form method='post'>
                                    <input type='password'  name='aktualni_heslo' placeholder='Aktuální heslo'/><br />
                                    <input type='password'  name='nove_heslo' placeholder='Nové heslo'/><br />
                                    <input type='password'  name='nove_heslo_znova' placeholder='Potvrzení hesla'/><br />
                                    <input type='hidden' name='sending'>
                                    <input type='submit' value='Změnit heslo' />
                                </form>";
                        }else{
                            if(md5($_POST["aktualni_heslo"])==$vypis_heslo["heslo"] && $_POST["nove_heslo"]==$_POST["nove_heslo_znova"]){
                                                            
                            $nove_zadane_heslo = md5($_POST["nove_heslo"]);
                            $uloz_nove_heslo="UPDATE uzivatele SET `heslo` = '$nove_zadane_heslo' WHERE `uzivatele`.`id` = {$_SESSION['id']};";
                                
                            $uloz_heslo = mysqli_query($db_spojeni, $uloz_nove_heslo);
							  if($uloz_heslo){
                                   echo "zmeneno"; 
                              } else {
                                  echo "chyba";
                            }   
                        } else {
                            echo "neco nesouhlasi";
                        }
                    }
?>
<?php 
ob_start();
session_start();
include 'db.php';

if(!isset($_SESSION["id"])){
    header("Location: index.php");
    exit;
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link rel="stylesheet" href="css/styly.css" type="text/css">
  <link rel="stylesheet" href="css/form.css" type="text/css">
  
  <title></title>
  </head>
  <body>
     <?php
     include 'menu.php';
      

      
      
      ?>
      

      
    <div class="center" style="padding-top:100px;">
        <div class="form" style="padding-left:25%;">
            
        <h2>Profil uživatele</h2>
    <?php
if(isset($_POST["jmeno"])) {
  if($_POST["jmeno"]=="") {echo "chybi jmeno"; }
  else {
                            $jmeno = $_POST["jmeno"];
                            $prijmeni = $_POST["prijmeni"];
                            $email = $_POST["email"];
                            $login = $_POST["login"];
                            $edituj_profil = "UPDATE uzivatele SET `jmeno` = '$jmeno',`prijmeni` = '$prijmeni',`email` = '$email',`login` = '$login' WHERE `uzivatele`.`id` = {$_SESSION['id']} LIMIT 1;";
                                
                            $dokonci_editaci = mysqli_query($db_spojeni, $edituj_profil);
							  if($dokonci_editaci){
                                   echo "zmeneno"; 
                              } else {
                                  echo "chyba";
                            }   
      
  
  }
}    else   {
       $id_prihlaseneho = $_SESSION["id"];
        $query = "SELECT * FROM uzivatele where uzivatele.id='$id_prihlaseneho'";
        $result =mysqli_query($db_spojeni,$query);
        $row = mysqli_fetch_array($result);
    ?>
        <form method="post">
       <label>Jméno:</label> <input type="text" name="jmeno" value="<?php echo $row['jmeno']; ?>"> <br>
       <label>Přijmení:</label> <input type="text" name="prijmeni" value="<?php echo $row['prijmeni']; ?>"><br>
       <label>Email:</label> <input type="text" name="email" value="<?php echo $row['email']; ?>">             <br>
       <label>Login:</label> <input type="text" name="login" value="<?php echo $row['login']; ?>">                 <br>
       <input type="hidden" name="editace_profilu">                 <br>
       <input type="Submit" value="Editovat profil">
</form>
<?php    
}      
     ?>       
            
            
    
    




              
 
        </div>
    </div>
    <footer>
            <div id="footer">
                2017 © Kamil Vavřička
                <a href="index.php" title="Kamil Vavřička" class="promo-icon"></a>
            </div>
        </footer>
  </body>
</html>
<?php
ob_end_flush();
?>
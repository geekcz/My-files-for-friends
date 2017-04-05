<?php 
session_start();
include 'db.php';
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
            
<form action="update.php" method="post">
        <h2>Profil uživatele</h2>
        <a href="editace_profilu.php" title="Editace profilu">Editace profilu</a><br><br>
        <?php
        $id_prihlaseneho = $_SESSION["id"];
        $query = "SELECT * FROM uzivatele where uzivatele.id='$id_prihlaseneho'";
        $result =mysqli_query($db_spojeni,$query);
        while($row = mysqli_fetch_array($result)){
        ?>
       <label>Jméno:</label><?php echo $row['jmeno']; ?> <br>
       <label>Přijmení:</label> <?php echo $row['prijmeni']; ?><br>
       <label>Email:</label><?php echo $row['email']; ?>             <br>
       <label>Login:</label><?php echo $row['login']; ?>                 <br>
       <label>Práva:</label><?php echo $row['prava']; ?>                 <br>
       <label>Heslo:</label><a href="zmena-hesla.php" title='Změnit heslo'>Změnit heslo</a>                   <br>
        <?php
        } //Close while{} loop
        ?>

</form>


              
 
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

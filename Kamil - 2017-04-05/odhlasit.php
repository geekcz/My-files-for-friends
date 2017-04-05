<?php
session_start(); 
ob_start();
include 'db.php';
unset($_SESSION["id"]);  
unset($_SESSION["login"]);  
unset($_SESSION["prava"]);  
header("Location: index.php");
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
          <h1>Odhlášení</h1>
      
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
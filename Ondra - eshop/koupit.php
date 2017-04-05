<?php
ob_start();
    session_start();
include 'dbh.php';

if(!isset($_SESSION["email"])) {
      header('Location: prihlaseni.php');
        exit;
    }
ob_end_flush();
?>

<!doctype html>
<html>
  <head>
	<?php include 'head.php'; ?>
  </head>
  <body onload="load()">
  <div id="body"><!-- blok celé stránky -->

    <div id="header">
<?php
include 'hlavicka.php';
?>
    </div>

    <?php  include 'menu.php'; ?>

    <div class="clanekK">
      <article>     
          
 <div class='kos'>
<?php    
          function zkrat($popis){
   $lenthPopis =  strlen("$popis");
    if($lenthPopis>70){
        $lenth=substr($popis,0,120)."...";
        return $lenth;
    }
    else{
       return $popis;
    } }     
              
     if(isset($_SESSION["kosik"])) {  
      
         if(isset($_POST["odeslat"])){
         include 'mail.php';
         unset($_SESSION["kosik"]);
         echo "<div class='kos'><h1>Vaše objednávka byla přijata ke zpracování. Nyní si můžete 
         zkontrolovat email, kde byly zaslány údaje o objednávce.</h1></div>";
         exit;
     }
         
         if(isset($_POST["smazat"])){
             $icko = $_POST['p'];
              unset($_SESSION["kosik"][$icko]);
             $_SESSION["kosik"] = array_values($_SESSION["kosik"]);
            if($_SESSION["kosik"][$icko]==''){
                unset($_SESSION["kosik"]);
                echo "<div class='kos'><h1>Nemáte v košíku žádné zboží</h1></div>";
                exit;
            } }
         
     $cisilko="";    
          for($i=0; $i<count($_SESSION['kosik']); $i++){
              $sql = "SELECT * FROM zbozi WHERE id={$_SESSION['kosik'][$i]};";
              $data=mysqli_query($conn,$sql);
              $zaznam=mysqli_fetch_array($data);
                $nazev=$zaznam['nazev'];
                $vyrobce=$zaznam['vyrobce'];
                $popis=zkrat($zaznam['popis']);
                $cisilko=$i+1;  
              if($zaznam['foto']=='0'){$zaznam['foto']='0.jpg';} else {$zaznam['foto'];}
?>
     <div class="prod">
         
<div class="foto">
  <img class="img" src="../katalog/<?php echo $zaznam['foto']; ?>" alt="<?php echo $zaznam['foto']; ?>" title="harley" width="auto" height="95px">
</div>

<div class="nadp">
<h1 class="h1"><?php echo $nazev; ?></h1>
<h3 class="h3"><?php echo $vyrobce; ?></h3>
</div>

<div class="pop">
<p class="p"><?php echo $popis; ?></p>
</div>

<div class="cen">
    <!-- <input type="number" value="<?php echo count($zaznam["id"]) ?>"> -->
<h2 class="h2"><?php echo $zaznam['cena']; ?>&nbsp;Kč&nbsp;s&nbsp;DPH</h2>
</div>
    
<div class="smazat">
    <form method="post" onsubmit="koupit.php?id=<?php echo $i; ?>">
        <input type="hidden" value="<?php echo $i; ?>" name="p">
<h2 class="h2"><input type="submit" value="Smazat" name="smazat" class="button7"></h2>
        </form>
</div>
    
   
     <?php }   
         
         $cena = "";
  for($i=0; $i<count($_SESSION['kosik']); $i++){       
     $celkem = "SELECT SUM(cena) AS cena FROM zbozi WHERE id={$_SESSION['kosik'][$i]};";
     $sqli = mysqli_query($conn,$celkem); 
     $zazn=mysqli_fetch_array($sqli); 
                $cena = $cena + $zazn["cena"];
  }
         $pocet = array_sum($_SESSION["kosik"]);
         echo "Počet ks: {$cisilko}"; 
     ?>
     <div class='kosicek'>
         <label>Celková&nbsp;cena:&nbsp;<b><?php echo $cena ?>&nbsp;s&nbsp;DPH</b></label>
     </div>
     <div class='kosicek'>
         <form method="post" onsubmit="koupit.php?id=<?php echo $i; ?>">
         <input type="submit" name="odeslat" value="Odeslat nákup" class="button7">
         </form>
     </div>
          
  <?php    
      } else {
         echo "<div class='kos'><h1>Nemáte v košíku žádné zboží!</h1></div>";
         exit;
     } 
    ?>
</div> 
</div>
      </article><!-- konec obsahu -->
    </div>

    <div id="footer">
      <footer><!-- patička -->
        &copy;2016
      </footer>
    </div>
  </div><!-- konec bloku stránky -->
  </body>
</html>

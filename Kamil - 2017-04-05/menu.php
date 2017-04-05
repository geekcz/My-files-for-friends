<div id="hlavicka">
        <div class="center">
            <a class="logo" href="index.php">Applikádo</a>
             <?php
              if(isset($_SESSION['email'])){
                  echo "<li><a href='index.php'>".$_SESSION['email']."</a></li>
                        <li><a href='odhlaseni.php'>logout</a></li>";
                }
  ?>    
            <label for="display-menu" class="our-menu">Menu</label>
            <input type="checkbox" id="display-menu">
            <ul id="hor-menu">
                <li><a href="index.php">Domů</a></li>
                <li><a href="katalog.php">Katalog her</a></li>
                <li><a href="index.php">Články</a></li>
                            
                <?php   
    if(($_SESSION['prava']=='1') && (isset($_SESSION["login"]))){
        echo "<li><a href='editace.php'>Přidat článek</a></li>
              <li><a href='vklad_katalog.php'>Přidat aplikaci</a></li>";
    }
                
         if(isset($_SESSION['login'])){
           echo "<li><a href='profil.php'>přihlášen - ".$_SESSION['login']."</a></li>
                 <li><a href='odhlasit.php'>Odhlásit</a></li>";
         } else {
          echo "<li><a href='prihlasovani.php'>Přihlášení</a></li>
                <li><a href='registrace.php'>Registrace</a></li>";
         }        ?>
                 
                
                      
            </ul>
            <ul >
                  
            </ul>
            <div class="clear"></div>
        </div>
    </div>
   
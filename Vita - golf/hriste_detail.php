<?php
        session_start();
if(isset($_SESSION['email'])){
    echo $_SESSION['email'];
}
        ?>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css.css">
    <link rel="stylesheet" type="text/css" href="csstest.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    </head>
    <body>
        <?php
    include 'server.php';
        
        
       
        ?>
        <div class="pozadi">
        <nav class="navBar">
            <nav class="lista">
        <div class="logo">GolfTime</div>
                <input type="checkbox" id="menu-tlac">
                <label for="menu-tlac" class="label-tlac"></label>
            <ul>
            <a href="index.php"><li>Domu</li></a>
            <a href="hriste.php"><li>Hriste</li></a>
            <a href="hraci.php"><li>Hraci</li></a>
            <a href="turnaje.php"><li>Turnaje</li></a>
                <?php
                if(isset($_SESSION['email'])){
                   echo "<a href='profil.php'><li>Profil</li></a> <a href='odhlasit.php'><li>Odhlasit</li></a>" ;
                }else{
                    echo "<a href='prihlaseni.php'><li>Prihlasit</li></a> <a href='registrace.php'><li>Registrace</li></a>" ;
                  
                    
                }
                ?>
           <?php
                $id=$_GET['id'];
            $dotaz=mysqli_query($connect,"SELECT * FROM hriste where hriste_id=$id");
    
           $zaznam = mysqli_fetch_array($dotaz);
			
                
            
            ?>
            </ul>
        </nav>
            </nav>
        <header class="lista">
        
        <h1><?php echo $zaznam["nazev_hriste"]; ?></h1>
       
        <div class="obal-hr">
            
            <div class="foto-hr">fotka</div>
            
            <div class="druhy">

                <?php
                
            if(isset($_POST["datum"])){
                if($_POST["datum"]==""){echo "zadej datum";}
                else{
                    $datum = $_POST["datum"];
                    $cas = $_POST["cas"];
                    $pocet_hracu = $_POST["pocet_hracu"];
                    $pridal=$_SESSION["id"];

                    $sql = "INSERT INTO rezervace_casu (uzivatel_id, cas, datum, hriste_id, pocet_hracu) VALUES ('$pridal', '$cas', '$datum', '$id', '$pocet_hracu')";
                    
                    
                        $dotaz=mysqli_query($connect,$sql);
                        if($dotaz){
                            echo "ok";
                        } else {
                            echo "ne!";
                        }
                    }
            }
                ?>

                <div class="rezer-hr">
                    <form method="post">
                Rezervovat cas<br>
                Datum: <input type="date" name="datum"><br>
                Čas: <input type="time" name="cas"><br>
                Počet hráčů:<input type="number" max="4" name="pocet_hracu"><br>
                <input type="submit" value="Rezervovat čas">
                        </form>
            </div>
            <div class="popis">
             <label>Popis:<?php echo $zaznam["informace"]; ?></label>
            </div>
            
            </div>
           
            </div>
            <div class="turnaje">
                <label>Turnaje</label>
           <label> <?php
            $hristed=mysqli_query($connect,"SELECT turnaje.turnaj_id, turnaje.nazev, turnaje.zahajeni, hriste.nazev_hriste FROM turnaje,hriste WHERE $id=hriste.hriste_id AND $id=turnaje.id_hriste");
    
           echo" <table> <tr class='turnaje-vypis'>";
            
            echo" <th class='radek-horni'>Nazev</th>";  
               echo" <th class='radek-horni'>Datum</th>";
               echo" <th class='radek-horni'>Detail</th>";
                echo"</tr><tr class='turnaje-vypis'>";

               
             while($hristez = mysqli_fetch_array($hristed)) {
			echo("<td>".$hristez["nazev"]."</td>");
            
            echo("<td>".$hristez["zahajeni"]."</td>");
            echo("<td><a href='turnaj_detail.php?id={$hristez["turnaj_id"]}' >Detail</a></td>");
                    echo"</tr><tr class='turnaje-vypis'>";
			
	}
            echo"    </tr> </table>";
               
            
               ?></label>
            
            </div>
        </header>
        <article></article>
        <footer></footer>
       </div>
    </body>

</html>

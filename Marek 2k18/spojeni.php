<?php
$server="localhost";
$uzivatel="root";
$heslo="";
$databaze="fimo";
$spojeni=new mysqli($server,$uzivatel,$heslo,$databaze); 
$spojeni->set_charset("utf8");                        
?>

<?php
// pouzijes takto 
// $pekne_datum = ceskeDatum($db_datum);

    function ceskeDatum($datum){
        $rok = substr($datum,0,4);
        $mesic = substr($datum,5,2);
        $den = substr($datum,8,2);
        if (substr($mesic,0,1)=="0") $mesic = substr($mesic,1,2);
        if (substr($den,0,1)=="0") $den = substr($den,1,1);
       // return "$den.."."&nbsp;"."$mesic"."&nbsp;"."$rok";
        return "$den.&nbsp;$mesic.&nbsp;$rok";
    }
?>
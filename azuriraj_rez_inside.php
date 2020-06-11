<?php
    require 'header.php'; 
    $veza=spojiSeNaBazu();
?>

<?php
    $tekma = $_GET['utakmica_id']; 
    $rez1 = $_GET['rez1']; 
    $rez2 = $_GET['rez2'];
    $upit = "UPDATE utakmica SET rezultat_1 = $rez1, rezultat_2 = $rez2 where utakmica_id = $tekma"; 
    
    $rezultat = izvrsiUpit($veza,$upit); 


    $sql2 = "select listic_id, status from listic where utakmica_id = $tekma;"; 
    $izv2 = izvrsiUpit($veza,$sql2);
    while (list($listic_id,$status)=mysqli_fetch_array($izv2)) {
        if ($status=='O') {
            $sql3= "delete from listic where listic_id = $listic_id"; 
        }
        $rez2 = izvrsiUpit($veza,$sql3);
    }

    $sql = "select ocekivani_rezultat from listic where utakmica_id = $tekma;"; 
    $izv = izvrsiUpit($veza,$sql);
    while (list($ocekivani_rezultat)=mysqli_fetch_array($izv)) {
        if ($rez1>$rez2) { 
            if ($ocekivani_rezultat==1) 
                $sqll = "UPDATE listic SET status = 'D' where utakmica_id=$tekma;"; 
            else 
                $sqll = "UPDATE listic SET status = 'N' where utakmica_id=$tekma;"; 
        }

        if ($rez1==$rez2) {
            if ($ocekivani_rezultat==0)
                $sqll = "UPDATE listic SET status = 'D' where utakmica_id=$tekma;";
            else 
                $sqll = "UPDATE listic SET status = 'N' where utakmica_id=$tekma;";
        }

        if ($rez1<$rez2) {
            if ($ocekivani_rezultat==2) 
                $sqll = "UPDATE listic SET status = 'D' where utakmica_id=$tekma;";
            else 
                $sqll = "UPDATE listic SET status = 'N' where utakmica_id=$tekma;"; 
        }
        $opetrez = izvrsiUpit($veza,$sqll);
    }


    header("location: index.php");
    zatvoriVezuNaBazu($veza);
?>  
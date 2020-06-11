<?php
    require 'header.php'; 
    $veza=spojiSeNaBazu();

    if ( isset($_GET['liga_id']) ) { 
        $_SESSION['liga_id'] = $_GET['liga_id'];
        $mimi =  $_SESSION['liga_id'];
    }
  
    else {
        $_SESSION['liga_id']=0;
    }
?>

<?php
    if(isset($_POST['submit'])) {
        $momcad1=$_POST['momcad1'];
        $momcad2=$_POST['momcad2'];

        if ($momcad1==$momcad2) {
            header("location: dodaj_utakmicu.php?greska: iste momčadi");
            exit();
        }

        if ((isset($_POST['rezultat1'])&&$_POST['rezultat2'])&&$_POST['rezultat1']>=0&&$_POST['rezultat2']>=0) {
            $rezultat1=$_POST['rezultat1'];
            $rezultat2=$_POST['rezultat2'];
        } 

        else {
            $rezultat1=-1;
            $rezultat2=-1;
        }

        $datum_pocetka=$_POST['datum'];
        $vrijeme_pocetka=$_POST['vrijeme'];

        if (!empty($datum_pocetka)&&!empty($vrijeme_pocetka)) {

            $datum_pocetka_sredeno = promjeniDatumZaBazu($datum_pocetka);
            $datum_vrijeme_pocetka = $datum_pocetka_sredeno. ' ' .$vrijeme_pocetka;
            $dat_vri = strtotime($datum_vrijeme_pocetka);
            $dat_vriKaoDat_vri= date('Y-m-d H:i:s', $dat_vri); 
            $datumVrijemeZavrsetka =  strtotime('+90 minutes', strtotime($dat_vriKaoDat_vri));
            $datum_vrijeme_zavrsetka = date('Y-m-d H:i:s', $datumVrijemeZavrsetka); 
            
            $upit = "INSERT INTO utakmica (momcad_1, momcad_2, datum_vrijeme_pocetka, datum_vrijeme_zavrsetka ,rezultat_1, rezultat_2)
                    values ('$momcad1', '$momcad2', '$datum_vrijeme_pocetka', '$datum_vrijeme_zavrsetka', '$rezultat1', '$rezultat2');";

            $rezultat = izvrsiUpit($veza,$upit);
            header("location: index.php?mom1=$momcad1?mom2=$momcad2?$datum_vrijeme_pocetka?$datum_vrijeme_zavrsetka?$rezultat1?$rezultat2");
            zatvoriVezuNaBazu($veza);
        }
    }
?>
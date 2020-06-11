<?php
    require 'header.php'; 
    $veza=spojiSeNaBazu();
    if ( isset($_GET['liga_id']) ) { 
        $_SESSION['liga_id'] = $_GET['liga_id'];
    }

    else {
        $_SESSION['liga_id']=0;
    }
?>

<div class="container">
                <table class= "tablica">
                        <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Slika</th>
                                  <th>Naziv</th>
                                  <th>Video</th>
                                  <th>Opis</th>
                                </tr>
                        </thead> 
                        <tbody>   
<?php
    if ($veza) {
        if ($aktivni_korisnik_tip==1) {
            $upit = "select liga_id,naziv,slika,video,opis from liga where moderator_id = $aktivni_korisnik_id;"; 
            
        }
        else   
        $upit = "select liga_id,naziv,slika,video,opis from liga;";
        
        $rezultat = izvrsiUpit($veza,$upit);
        while(list($liga_id,$naziv,$slika,$video,$opis)=mysqli_fetch_array($rezultat)){
            echo 
            "
            <tr id=\"red\" onclick=\"document.location.href = 'dodaj_utakmicu_inside.php?liga_id=$liga_id'\">
                <td>$liga_id</td>
                <td><img src = $slika class=\"slika\"></td>
                <td>$naziv</td>
                <td>$video</td>
                <td>$opis</td>
            </tr>
            ";
        }
    }

    zatvoriVezuNaBazu($veza);
?>
</tbody>

</section>
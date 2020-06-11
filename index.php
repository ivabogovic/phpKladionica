<?php
    require 'header.php';
    $veza=spojiSeNaBazu();

if ( isset($_GET['liga_id']) )  $_SESSION['liga_id'] = $_GET['liga_id'];
else 
    $_SESSION['liga_id']=0; 
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
                                  <?php
                                    if ($aktivni_korisnik_tip==0) echo "<th>Opcija</th>"; 
                                  ?>
                                </tr>
                        </thead> 
                        <tbody>   
<?php
    if ($veza) {
        $upit = "select liga_id,moderator_id,naziv,slika,video,opis from liga where liga_id is not null;"; 
        $rezultat = izvrsiUpit($veza,$upit);
        while(list($liga_id,$moderator_id, $naziv,$slika,$video,$opis)=mysqli_fetch_array($rezultat)){ 
            echo 
            "
            <tr id=\"red\" onclick=\"document.location.href = 'utakmice.php?liga_id=$liga_id'\"> 
                <td>$liga_id</td>
                <td><img src = $slika class=\"slika\"></td>
                <td>$naziv</td>
                <td>
                    <video width=\"320\" height=\"540\" controls>
                    <source src=\"$video\">
                    </video>
                </td>
                <td>$opis</td>";
                if ($aktivni_korisnik_tip==0) echo "<td> <a href='azuriraj_ligu.php?liga_id=$liga_id&moderator_id=$moderator_id'>Ažuriraj</a></td>";
           echo " </tr>
            ";
        }
    }

    zatvoriVezuNaBazu($veza);
?>
</tbody>

</section>
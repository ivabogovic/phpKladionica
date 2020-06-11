<?php
    require 'header.php';
    $veza=spojiSeNaBazu();
?>

<div class="container">
                <table class= "tablica">
                        <thead>
                                <tr>
                                  <th>#</th>
                                  <th>korisnik</th>
                                  <th>liga</th>
                                  <th>momcad 1</th>
                                  <th>momcad 2</th>
                                  <th>vrijeme pocetka</th>
                                  <th>rezultat</th>
                                  <th>status</th>
                                  <th>opcija</th>
                                </tr>
                        </thead> 
                        <tbody>

<?php

    $upit = "select listic_id, korisnik.ime, korisnik.prezime, utakmica_id, ocekivani_rezultat, status from listic, korisnik where listic.korisnik_id = $aktivni_korisnik_id and listic.korisnik_id=korisnik.korisnik_id;";
    
    $rezultat = izvrsiUpit($veza,$upit);
    while(list($listic_id,$korisnik_ime, $korisnik_prezime, $utakmica_id, $ocekivani_rezultat, $status)=mysqli_fetch_array($rezultat)) {
        $upit1 = "select momcad_1, momcad_2, datum_vrijeme_pocetka from utakmica where utakmica_id=$utakmica_id;";
        $rezultat1 = izvrsiUpit($veza,$upit1);
        while(list($momcad_1, $momcad_2, $datum_vrijeme_pocetka)=mysqli_fetch_array($rezultat1)) {
            $domacinUpit = "select naziv from momcad where momcad_id=$momcad_1;";
            $gostUpit = "select naziv from momcad where momcad_id=$momcad_2;";
            $ligaUpit = "select liga.naziv from liga, momcad where momcad.momcad_id=$momcad_1;";
            $rez1 = izvrsiUpit($veza,$domacinUpit);
            list($momcad_1_naziv)=mysqli_fetch_row($rez1); 
            $rez2 = izvrsiUpit($veza,$gostUpit);
            list($momcad_2_naziv)=mysqli_fetch_row($rez2);
            $rez3 = izvrsiUpit($veza,$ligaUpit);
            list($liga)=mysqli_fetch_row($rez3);
            $datum = promjeniDatumZaPrikaz($datum_vrijeme_pocetka);
        }

        echo 
        "<tr>
        <td>$listic_id</td>
        <td>$korisnik_ime  $korisnik_prezime</td>
        <td>$liga</td>
        <td>$momcad_1_naziv</td>
        <td>$momcad_2_naziv</td>
        <td>$datum</td>
        <td>$ocekivani_rezultat</td>
        <td>$status</td>";
        if ($status == 'O') echo "<td><a href='predaj_listic.php?listic_id=$listic_id'>Predaj</a></td>"; 
        
    echo "</tr>";
    }
    zatvoriVezuNaBazu($veza);
?>

</tbody>
</table>
</div>

</section>
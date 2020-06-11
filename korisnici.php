<?php
    require 'header.php';
    $veza=spojiSeNaBazu();

?>

<div class="container">

        <table class= "tablica">
            <thead>
              <tr>
                <th>#</th>
                <th>Tip korisnika</th>
                <th>Korisničko ime</th>
                <th>Ime</th>
                <th>Prezime</th>
                <th>Email</th>
                <th>Slika</th>
                <th>Opcija</th>
                </tr>
            </thead> 
            <tbody>
                <?php
                    $upit = "select korisnik_id, tip_korisnika_id, korisnicko_ime, ime, prezime, email, slika from korisnik;";
                    $rezultat = izvrsiUpit($veza,$upit);
                    while (list($ID, $tip_kor, $kor_ime, $ime, $prezime, $email, $slika)=mysqli_fetch_array($rezultat)) {
                        $sql = "select naziv from tip_korisnika where tip_korisnika_id=$tip_kor;";
                        $rez=izvrsiUpit($veza,$sql);
                        list($tip)=mysqli_fetch_row($rez);
                        echo 
                        "
                        <tr>
                            <td>$ID</td>
                            <td>$tip</td>
                            <td>$kor_ime</td>
                            <td>$ime</td>
                            <td>$prezime</td>
                            <td> $email</td>
                            <td><img src = $slika class=\"slika\"></td>";
                           echo "<td><a href='azuriraj_korisnika.php?korisnik_id=$ID&tip_korisnika_id=$tip_kor'>Ažuriraj</a></td>";
                       echo  "</tr>";
                        
                    }
                ?>
            </tbody>
            </table>
</div>

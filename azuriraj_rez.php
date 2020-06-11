<?php
    require 'header.php'; 
    $veza=spojiSeNaBazu();
    
?>

<div class="container">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Momčad 1</th>
                    <th>Momčad 2</th>
                    <th>Rez1</th>
                    <th>Rez2</th>
                    <th>Vrijeme početka</th>
                    <th>Vrijeme kraja</th>
                    <th>Opis</th>
                </tr>
            </thead>
            <tbody>

                <?php
                if ($aktivni_korisnik_tip==1) {
    $upit = "SELECT DISTINCT utakmica_id, momcad_1, momcad_2, datum_vrijeme_pocetka, datum_vrijeme_zavrsetka, rezultat_1, rezultat_2, utakmica.opis 
    from utakmica 
    join liga 
    on liga.moderator_id=$aktivni_korisnik_id
    where rezultat_1=-1;"; 
                }

                if ($aktivni_korisnik_tip==0) {
                    $upit = "SELECT DISTINCT utakmica_id, momcad_1, momcad_2, datum_vrijeme_pocetka, datum_vrijeme_zavrsetka, rezultat_1, rezultat_2, utakmica.opis 
    from utakmica 
    where rezultat_1=-1;";
                } 

    $rezultat = izvrsiUpit($veza,$upit);
    while(list($utakmica_id, $momcad_1, $momcad_2, $datum_vrijeme_pocetka, $datum_vrijeme_zavrsetka, $rezultat_1,$rezultat_2, $opis)=mysqli_fetch_array($rezultat)) {
        $domacinUpit = "select naziv from momcad where momcad_id=$momcad_1;";
        $gostUpit = "select naziv from momcad where momcad_id=$momcad_2;"; 
        $rez1 = izvrsiUpit($veza,$domacinUpit);
        list($momcad_1_naziv)=mysqli_fetch_row($rez1);
        $rez2 = izvrsiUpit($veza,$gostUpit);
        list($momcad_2_naziv)=mysqli_fetch_row($rez2);

        $datum_pocetka = promjeniDatumZaPrikaz($datum_vrijeme_pocetka);
        $datum_zavrsetka = promjeniDatumZaPrikaz($datum_vrijeme_zavrsetka);

        if ($datum_vrijeme_pocetka<date("Y-m-d H:i:s")) { 
        echo 
        "
            <tr>
                <td>$utakmica_id</td>
                <td>$momcad_1_naziv</td>
                <td>$momcad_2_naziv</td>
                <td> <input class=\"rez1\" id = \"rez1\"> </td>
                <td> <input class=\"rez1\" id = \"rez2\"> </td> 
                <td> $datum_pocetka</td>
                <td> $datum_zavrsetka</td>
                <td> $opis</td>
                <td> <button type=\"submit\" name= \"azuriraj\" onclick = \"dodajRezultat($utakmica_id)\">Ažuriraj 
                </button> </td>
                            </tr>
         ";
    }
}
?>

</tbody>
        </table>
    </div>
</div>
</section>
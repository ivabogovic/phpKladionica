<?php
    require 'header.php';
    $veza=spojiSeNaBazu();
?>
<section>
    <form method="post" action="stat_liga.php">
        <label>Datum i vrijeme početka </label>
        <input type="text" name="datum_vrijeme_pocetka" required value="<?php if (isset($_POST['datum_vrijeme_pocetka'])) echo date("d.m.Y H:i:s", strtotime($_POST['datum_vrijeme_pocetka'])); ?>"><br/>
        <label>Datum i vrijeme završetka</label>
        <input type="text" name="datum_vrijeme_zavrsetka" required value="<?php if (isset($_POST['datum_vrijeme_zavrsetka'])) echo date("d.m.Y H:i:s", strtotime($_POST['datum_vrijeme_zavrsetka'])); ?>"><br/>
        <label>Sortiraj prema dobitnim listicima</label>
        <select name="sortiranje">
            <option value="ASC">rastuće</option>
            <option value="DESC">padajuće</option>
        </select><br/>
        <input type="submit" value="Prikaži statistiku">
    </form>

    <table class = "tablica">
        <thead><th>Korisnik</th><th>Broj dobitnih listića</th><th>Broj nedobitnih listića</th></thead>
        <tbody>
            <?php
                if ($_SERVER['REQUEST_METHOD'] == "POST"){
                    $datum_vrijeme_pocetka = promjeniDatumZaBazu($_POST['datum_vrijeme_pocetka']);
    $datum_vrijeme_zavrsetka =promjeniDatumZaBazu($_POST['datum_vrijeme_zavrsetka']);
    $sortiranje = $_POST['sortiranje'];

    $upit = "SELECT l.korisnik_id, SUM(CASE WHEN l.status = 'D' THEN 1 ELSE 0 END) AS dobitni, SUM(CASE WHEN l.status='N' THEN 1 ELSE 0 END) AS nedobitni FROM listic l, utakmica u WHERE l.utakmica_id=u.utakmica_id AND u.datum_vrijeme_zavrsetka BETWEEN '".$datum_vrijeme_pocetka."' AND '".$datum_vrijeme_zavrsetka."' GROUP BY l.korisnik_id ORDER BY dobitni ".$sortiranje;
    $rezultat = izvrsiUpit($veza, $upit);

    if (mysqli_num_rows($rezultat) == 0){
        echo "<tr><td colspan='3'>U odabranom razdoblju nema niti jednog korisnika koji je uplatio listić!</td></tr>";
    }
    else {
        while ($listic = mysqli_fetch_assoc($rezultat)){
            $upit = "SELECT * FROM korisnik WHERE korisnik_id=".$listic['korisnik_id'];
            $rezultat1 = izvrsiUpit($veza, $upit);
            $korisnik = mysqli_fetch_assoc($rezultat1);

            echo "<tr>";
            echo "<td>".$korisnik['ime']." ".$korisnik['prezime']."</td>";
            echo "<td>".$listic['dobitni']."</td>";
            echo "<td>".$listic['nedobitni']."</td>";
            echo "</tr>";
        }
    }
}

            
            ?>
        </tbody>
    </table>
</section>
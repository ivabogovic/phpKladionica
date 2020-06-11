<?php
    require 'header.php';
    $veza=spojiSeNaBazu();
    $_SESSION['liga_id']= $_GET['liga_id'];
    $idLiga =   $_SESSION['liga_id'];
?>

<div class="container">
        <table class="tablica">
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
                                $upit = "select utakmica_id, momcad_1, momcad_2, datum_vrijeme_pocetka, datum_vrijeme_zavrsetka, rezultat_1, rezultat_2, utakmica.opis
                                from utakmica 
                                join momcad 
                                on utakmica.momcad_1=momcad.momcad_id 
                                where momcad.liga_id=$idLiga order by datum_vrijeme_pocetka; ";
                                 
                                 
                                $rezultat = izvrsiUpit($veza,$upit);
                                while(list($utakmica_id, $momcad_1, $momcad_2, $datum_vrijeme_pocetka, $datum_vrijeme_zavrsetka, $rezultat_1,$rezultat_2, $opis)=mysqli_fetch_array($rezultat)) {
                                     
                                    $domacinUpit = "select naziv from momcad where momcad_id=$momcad_1;";
                                    $gostUpit = "select naziv from momcad where momcad_id=$momcad_2;";
                                    $rez1 = izvrsiUpit($veza,$domacinUpit);
                                    list($momcad_1_naziv)=mysqli_fetch_row($rez1); 
                                    $rez2 = izvrsiUpit($veza,$gostUpit);
                                    list($momcad_2_naziv)=mysqli_fetch_row($rez2);
                                        if ($aktivni_korisnik_tip==-1&&$rezultat_1==-1) { 
                                            echo "";
                                        }
                                    else {
                                    if ($rezultat_1==-1) { 
                                        $rezultat_1 = "";
                                        $rezultat_2 = "";
                                    }

                                    $datum_pocetka = promjeniDatumZaPrikaz($datum_vrijeme_pocetka);
                                    $datum_zavrsetka = promjeniDatumZaPrikaz($datum_vrijeme_zavrsetka);

                                    echo 
                                        "
                                        <tr>
                                            <td>$utakmica_id</td>
                                            <td>$momcad_1_naziv</td>
                                            <td>$momcad_2_naziv</td>
                                            <td>$rezultat_1</td>
                                            <td>$rezultat_2</td>
                                            <td> $datum_pocetka</td>
                                            <td> $datum_zavrsetka</td>
                                            <td>$opis</td>
                                        </tr>
                                        ";
                                }
                                
                            }

                          
                          zatvoriVezuNaBazu($veza);
                            ?>
            </tbody>
        </table>
</div>
</section>
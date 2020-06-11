<?php
    require 'header.php';
    $veza=spojiSeNaBazu();

?>
<div class="container">
        <table class= "tablica">
            <thead>
              <tr>
                <th>#</th>
                <th>Momčad 1</th>
                <th>Momčad 2</th>
                <th>TIP</th>
                <th>Vrijeme početka</th>
                <th>Vrijeme kraja</th>
                <th>Opis</th>
                </tr>
            </thead> 
            <tbody>
                <?php
                    $upit  = "select utakmica_id, momcad_1, momcad_2, datum_vrijeme_pocetka, datum_vrijeme_zavrsetka, utakmica.opis 
                    from utakmica 
                    join momcad 
                    on utakmica.momcad_1=momcad.momcad_id 
                    where rezultat_1=-1 
                    order by datum_vrijeme_pocetka;";
                    
                    $rezultat = izvrsiUpit($veza,$upit); 
                    while(list($utakmica_id, $momcad_1, $momcad_2, $datum_vrijeme_pocetka, $datum_vrijeme_zavrsetka, $opis)=mysqli_fetch_array($rezultat)) {
                        $domacinUpit = "select naziv from momcad where momcad_id=$momcad_1;"; 
                        $gostUpit = "select naziv from momcad where momcad_id=$momcad_2;";
                        $rez1 = izvrsiUpit($veza,$domacinUpit);
                        list($momcad_1_naziv)=mysqli_fetch_row($rez1);
                        $rez2 = izvrsiUpit($veza,$gostUpit);
                        list($momcad_2_naziv)=mysqli_fetch_row($rez2);
                        $datum_pocetka = promjeniDatumZaPrikaz($datum_vrijeme_pocetka); 
                        $datum_zavrsetka = promjeniDatumZaPrikaz($datum_vrijeme_zavrsetka);
                            echo 
                            "
                            <tr>
                                <td>$utakmica_id</td>
                                <td>$momcad_1_naziv</td>
                                <td>$momcad_2_naziv</td>
                                <td>
                                <form method = \"get\">
                                    <span class = \"tipovi\">  
                                        <input type =\"button\" value = \"1\" class = \"tip\" onclick=\"dodajListic($utakmica_id, value)\">
                                        <input type =\"button\" value = \"0\" class = \"tip\" onclick=\"dodajListic($utakmica_id, value)\">
                                        <input type =\"button\" value = \"2\" class = \"tip\" onclick=\"dodajListic($utakmica_id, value)\">
                                     </span>
                                </form>
                                </td> 
                                <td> $datum_pocetka</td>
                                <td> $datum_zavrsetka</td>
                                <td>$opis</td>
                            </tr> 
                            "; 
                            
                            
                            
                            
                        }
                    


                ?> 
            </tbody>
            </table>
</div>
</section>
<?php
    require 'header.php';
    $veza=spojiSeNaBazu();
 
?>

<div class="container">
        <table class= "tablica">
            <thead>
              <tr>
                <th>Naziv</th>
                <th>Liga</th>
                <th>Opis</th>
                <th>Opcija</th>
                </tr>
            </thead> 
            <tbody><?php
                    $upit = "select momcad_id, liga_id, naziv, opis from momcad;";
                    $rezultat = izvrsiUpit($veza,$upit);
                    while (list($ID, $liga_id, $naziv, $opis)=mysqli_fetch_array($rezultat)) {
                        $sql = "select naziv from liga where liga_id=$liga_id;";
                        $rez=izvrsiUpit($veza,$sql);
                        list($liga)=mysqli_fetch_row($rez);
                        echo 
                        "
                        <tr>
                            <td>$naziv</td>
                            <td>$liga</td>
                            <td>$opis</td>";
                           echo "<td><a href='azuriraj_momcad.php?momcad_id=$ID&liga_id=$liga_id'>Ažuriraj</a></td>";
                       echo  "</tr>";
                    }
                ?>
            </tbody>
            </table>
</div>
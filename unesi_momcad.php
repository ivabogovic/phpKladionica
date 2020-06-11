<?php
    require 'header.php';
    $veza=spojiSeNaBazu();

?>
<div class="container"> 
                <form  method="post">
                        <input placeholder="Naziv" name = "naziv">
                        <br>
                        LIGA:  <select name = "liga">
                            <?php
                                $upit =  "select liga_id, naziv from liga;";
                                $rezultat = izvrsiUpit($veza,$upit);
                                while(list($id, $naziv)=mysqli_fetch_array($rezultat)) {
                                      echo "<option value=\"$id\"\> $naziv</option>";
                              }
                            ?>
                        </select>
                        <br>
                        <input placeholder="Opis (opcionalno)" name = "opis">
                        <br>
                    <input type="submit" name="submit" id = "submit"value="DODAJ">
                </form>
            </div>

            <?php
                    if (isset($_POST['submit'])) {
                        $liga_id = $_POST['liga'];
                        $naziv = $_POST['naziv'];
                        $opis = $_POST['opis'];
                        $upit = "INSERT INTO momcad (liga_id, naziv, opis) VALUES ('".$liga_id."','".$naziv."', '".$opis."')";
                        $rez = izvrsiUpit($veza,$upit);
                        header("location:momcadi.php");
                    }
            ?>

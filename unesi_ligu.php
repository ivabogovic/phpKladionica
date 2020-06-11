<?php
    require 'header.php';
    $veza=spojiSeNaBazu();
 
?>

<div class="container"> 
                <form  method="post">
                Moderator:  <select name = "moderator">
                            <?php
                                $upit =  "select korisnik_id, korisnicko_ime from korisnik where tip_korisnika_id = 1;";
                                $rezultat = izvrsiUpit($veza,$upit);
                                while(list($id, $naziv)=mysqli_fetch_array($rezultat)) {
                                      echo "<option value=\"$id\"\> $naziv</option>";
                              }
                            ?>
                        </select>
                        <br>
                        <input placeholder="Naziv" name = "naziv">
                        <br>
                        <input placeholder="Slika" name = "slika">
                        <br>
                        <input placeholder="Video" name = "video">
                        <br>
                        <input placeholder="Opis" name = "opis">
                        <br>
                    <input type="submit" name="submit" id = "submit"value="DODAJ">
                </form>
            </div>

<?php
    if (isset($_POST['submit'])) {
        $moderator = $_POST['moderator'];
        $naziv = $_POST['naziv'];
        $slika = $_POST['slika'];
        $video = $_POST['video'];
        $opis = $_POST['opis'];
        $upit = "INSERT INTO liga (moderator_id, naziv, slika, video, opis) VALUES (".$moderator.", '".$naziv."', '".$slika."', '".$video."', '".$opis."')";
        $rez = izvrsiUpit($veza,$upit);
        header("location:index.php");
    }
?>
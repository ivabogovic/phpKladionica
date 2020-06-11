<?php
    require 'header.php';
    $veza=spojiSeNaBazu();

?>

<?php
if (isset($_GET['liga_id'])){
    $upit = "SELECT * FROM liga WHERE liga_id=".$_GET['liga_id'];
    $rezultat = izvrsiUpit($veza,$upit);
    global $update;
    $update = mysqli_fetch_assoc($rezultat);
}
?>

<div class="container"> 
                <form  method="post">
                        <select name = "moderator">
                            <?php
                                $upit =  "select korisnik_id, korisnicko_ime from korisnik where tip_korisnika_id = 1;";
                                $rezultat = izvrsiUpit($veza,$upit);
                                while(list($id, $naziv)=mysqli_fetch_array($rezultat)) {
                                    if (isset($_GET['liga_id']) && $id == $_GET['moderator_id'])
                                      echo "<option selected value=\"$id\"\> $naziv</option>";
                                    else 
                                    echo "<option value=\"$id\"\> $naziv</option>";

                              }
                            ?>
                        </select>
                        <br>
                        <input type = "text" required value="<?php if (isset($_GET['liga_id'])) echo $update['naziv']; ?>" name = "naziv">
                        <br>
                        <input type = "text" required value="<?php if (isset($_GET['liga_id'])) echo $update['slika']; ?>" name = "slika">
                        <br>
                        <input type = "text" required value="<?php if (isset($_GET['liga_id'])) echo $update['video']; ?>" name = "video">
                        <br>
                        <input type = "text" required value="<?php if (isset($_GET['liga_id'])) echo $update['opis']; ?>" name = "opis">
                        <br>
                    <input type="submit" name="submit" id = "submit"value="DODAJ">
                </form>
            </div>

            <?php
                if (isset ($_POST['submit'])) {
                    $moderator = $_POST['moderator'];
                    $naziv = $_POST['naziv'];
                    $slika = $_POST['slika'];
                    $video = $_POST['video'];
                    $opis = $_POST['opis'];
                
                    $upit = "UPDATE liga SET moderator_id=".$moderator.", naziv='".$naziv."', slika='".$slika."', video='".$video."', opis='".$opis."' WHERE liga_id=".$_GET['liga_id'];
                    $rez = izvrsiUpit($veza,$upit);
                    header("location:index.php");
                    exit();
                }
            ?>
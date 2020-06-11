<?php
    require 'header.php';
    $veza=spojiSeNaBazu();

?>

<?php
if (isset($_GET['momcad_id'])){
    $upit = "SELECT * FROM momcad WHERE momcad_id=".$_GET['momcad_id'];
    $rezultat = izvrsiUpit($veza,$upit);
    global $update;
    $update = mysqli_fetch_assoc($rezultat);
}
?>

<div class="container"> 
                <form  method="post">
                <input type = "text" required value="<?php if (isset($_GET['momcad_id'])) echo $update['naziv']; ?>" name = "naziv">
                        <br>
                        <select name = "liga">
                            <?php
                                $upit =  "select liga_id, naziv from liga where liga_id != 0;";
                                $rezultat = izvrsiUpit($veza,$upit);
                                while(list($id, $naziv)=mysqli_fetch_array($rezultat)) {
                                    if (isset($_GET['momcad_id']) && $id == $_GET['liga_id'])
                                    echo "<option selected value=\"$id\"\> $naziv</option>";
                                  else 
                                  echo "<option value=\"$id\"\> $naziv</option>";
                              }
                            ?>
                        </select>
                        <br>
                        <input type = "text" required value="<?php if (isset($_GET['momcad_id'])) echo $update['opis']; ?>" name = "opis">
                        <br>
                    <input type="submit" name="submit" id = "submit"value="DODAJ">
                </form>
            </div>

            <?php
                if (isset ($_POST['submit'])) {
                    $liga = $_POST['liga'];
                    $naziv = $_POST['naziv'];
                    $opis = $_POST['opis'];
                
                    $upit = "UPDATE momcad SET liga_id=".$liga.", naziv='".$naziv."', opis='".$opis."' WHERE momcad_id=".$_GET['momcad_id'];
                    $rez = izvrsiUpit($veza,$upit);
                    header("location:index.php");
                    exit();
                }
            ?>
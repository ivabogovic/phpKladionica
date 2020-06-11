<?php
    require 'header.php';
    $veza=spojiSeNaBazu();

?>

<?php
if (isset($_GET['korisnik_id'])){
    $upit = "SELECT * FROM korisnik WHERE korisnik_id=".$_GET['korisnik_id'];
    $rezultat = izvrsiUpit($veza,$upit);
    global $update;
    $update = mysqli_fetch_assoc($rezultat);
}
?>

<div class="container"> 
                <form  method="post">
                        TIP KORISNIKA: <select name = "tip">
                            <?php
                                $upit =  "select tip_korisnika_id, naziv from tip_korisnika where tip_korisnika_id != 0;";
                                $rezultat = izvrsiUpit($veza,$upit);
                                while(list($id, $naziv)=mysqli_fetch_array($rezultat)) {
                                    if (isset($_GET['korisnik_id']) && $id == $_GET['tip_korisnika_id'])
                                    echo "<option selected value=\"$id\"\> $naziv</option>";
                                  else 
                                  echo "<option value=\"$id\"\> $naziv</option>";
                              }
                            ?>
                        </select>
                        <br>
                        Korisničko ime: <input type = "text" required value="<?php if (isset($_GET['korisnik_id'])) echo $update['korisnicko_ime']; ?>" name = "korisnicko_ime">
                        <br>
                        Ime: <input type = "text" required value="<?php if (isset($_GET['korisnik_id'])) echo $update['ime']; ?>" name = "ime">
                        <br>
                       Prezime:  <input type = "text" required value="<?php if (isset($_GET['korisnik_id'])) echo $update['prezime']; ?>" name = "prezime">
                        <br>
                        E-mail: <input type = "text" required value="<?php if (isset($_GET['korisnik_id'])) echo $update['email']; ?>" name = "email">
                        <br>
                        Slika: <input type="file" name="slika"><br/>
                        <br>
                    <input type="submit" name="submit" id = "submit"value="DODAJ">
                </form>
            </div>

            <?php
                if (isset ($_POST['submit'])) {
                    $tip = $_POST['tip'];
                    $korisnicko_ime = $_POST['korisnicko_ime'];
                    $ime = $_POST['ime'];
                    $prezime = $_POST['prezime'];
                    $email = $_POST['email'];
                    $slika = $_POST['slika'];
                  if ($slika=="")
                    $upit = "UPDATE korisnik SET tip_korisnika_id='".$tip."', korisnicko_ime='".$korisnicko_ime."',ime='".$ime."', prezime='".$prezime."', email='".$email."' WHERE korisnik_id=".$_GET['korisnik_id'];
                  else 
                  $upit = "UPDATE korisnik SET tip_korisnika_id='".$tip."', korisnicko_ime='".$korisnicko_ime."',ime='".$ime."', prezime='".$prezime."', email='".$email."',slika='".$slika."' WHERE korisnik_id=".$_GET['korisnik_id'];
                    $rez = izvrsiUpit($veza,$upit);

                    exit();
                }
            ?>
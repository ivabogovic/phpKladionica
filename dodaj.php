<?php
    require 'header.php';
    $veza=spojiSeNaBazu();

?>

<?php
    $tekma = $_GET['utakmica_id']; 
    $guess = $_GET['value']; 
    $upit = "insert into listic (korisnik_id, utakmica_id, ocekivani_rezultat, status) values($aktivni_korisnik_id, $tekma , $guess, 'O');"; 
    $rezultat = izvrsiUpit($veza,$upit); 
    header("location: popis_listica.php");
    zatvoriVezuNaBazu($veza);
?>

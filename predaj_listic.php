<?php
    require 'header.php';
    $veza=spojiSeNaBazu();
?>
 
 <?php
 $id = $_GET['listic_id'];
    $upit = "UPDATE listic SET listic.status='P' WHERE listic_id = $id;";
    $rezultat = izvrsiUpit($veza,$upit);
    header("location: popis_listica.php");
    zatvoriVezuNaBazu($veza);
?>
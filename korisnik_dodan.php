<?php
   require 'header.php'; 
   $veza=spojiSeNaBazu();
   if(isset($_POST['submit'])) {
        $ime = $_POST['ime'];
        $prezime = $_POST['prezime'];
        $korisnicko = $_POST['korisnicko'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $tip =  $_POST['tip'];


        if (isset($ime)&&isset($prezime)&&isset($korisnicko)&&isset($email)&&isset($password)) { 
            $sql = "INSERT INTO korisnik ( tip_korisnika_id, korisnicko_ime, lozinka, ime, prezime, email,slika)
            VALUES ('".$tip."', '".$korisnicko."', '".$password."','". $ime."', '".$prezime."', '".$email."', 'korisnici/bpitt.jpg');"; 
            $result = izvrsiUpit($veza,$sql);
            header("location: korisnici.php");
            zatvoriVezuNaBazu($veza);
        }
   }
?>
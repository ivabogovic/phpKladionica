<?php
    require 'baza.php'; 
    if(session_id()=="")session_start();
    

    $aktivni_korisnik=3;
    $aktivni_korisnik_tip=-1; 

    if(isset($_SESSION['aktivni_korisnik'])){ 
      $aktivni_korisnik=$_SESSION['aktivni_korisnik'];
      $aktivni_korisnik_ime=$_SESSION['aktivni_korisnik_ime'];
      $aktivni_korisnik_tip=$_SESSION['aktivni_korisnik_tip'];
      $aktivni_korisnik_id=$_SESSION["aktivni_korisnik_id"];
    }
    
    function promjeniDatumZaBazu($datum) {
      $trimaniDatum = rtrim($datum, '.'); 
      $noviDatum = str_replace('.', '-', $trimaniDatum);
      return date('Y-m-d', strtotime($noviDatum));
    }

    function promjeniDatumZaPrikaz($datum) {
      
      return date('d.m.Y H:i:s',strtotime($datum));
    }

    
?>


<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href = "./css/style.css"/>
        <script type="text/javascript" src="kladionica.js"></script>
</head>

<body>
<nav class="traka"> 
  <a class="naslov" href="index.php">Kladionica</a>
  <div class="opa" >
    <ul>
      <li>
      <a href="oautoru.php"> O autoru </a>
      </li>
      <li>
        <a href="index.php">Popis liga</a>
        </li>
      <?php
         if($aktivni_korisnik_tip!==-1) { 
         echo ' <li>
             <a href="kreiraj_listic.php">Kreiraj listić </a>
               </li>
                 <li>
                <a href="popis_listica.php">Popis listića </a>
               </li>';
        }

        if($aktivni_korisnik_tip!==-1&&$aktivni_korisnik_tip!=2) { 
          echo '
         <li >
          <a  href="dodaj_utakmicu.php">Dodaj utakmicu </a>
         </li>
         <li >
          <a  href="azuriraj_rez.php">Ažuriraj rezultat </a>
         </li>
         <li >
          <a  href="stat_liga.php">Statistika po ligi </a>
         </li>
         <li >
          <a  href="stat_kor.php">Statistika po korisniku </a>
         </li>'
      
         ;
        }

        if($aktivni_korisnik_tip!==-1&&$aktivni_korisnik_tip!=2&&$aktivni_korisnik_tip!=1) {
          echo '
         <li >
          <a  href="korisnici.php">Korisnici </a>
         </li>
         <li >
          <a  href="dodaj_korisnika.php">Dodaj korisnika </a>
         </li>
         <li >
          <a  href="unesi_ligu.php">Unesi ligu </a>
         </li>
         <li >
         <a  href="momcadi.php">Momcadi </a>
        </li>
         <li >
         <a  href="unesi_momcad.php">Unesi momcad </a>
        </li>';
        }
      ?>
    </ul>
    <?php
      if($aktivni_korisnik===3) { 
        echo  '<form class="prijava" method="POST" name="prijava" action="login.php">
        <input class="boks" type="text" placeholder="Korisničko ime" name="korisnicko_ime" id="korisnicko_ime" >
        <input class="boks" type="password" placeholder="Lozinka" name = "lozinka"	id="lozinka" >
        <button class="prijavise" type="submit" name= "submit">Prijavi se</button>
      </form>';
      }

      else{ 
        echo "<span>Bok, $aktivni_korisnik_ime</span><br/>";
        echo "<a class=\"odjavise\" href='login.php?logout=1' type=\"submit\">Odjavi se</a>";
      }
    ?>
  </div>
</nav>


    <section id="main">

    </header>
</html>
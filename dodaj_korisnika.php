<?php
    require 'header.php'; 
    $veza=spojiSeNaBazu();

?>

<div class = "container">
    <form action="korisnik_dodan.php" method="post">
            <div >
                <input type="text"  id="ime" name="ime" placeholder="Ime">
            </div>
            <div >
                <input type="text"  id="prezime" name="prezime" placeholder="Prezime">
            </div>
            <div >
                <input type="text"  id="korisnicko" name="korisnicko" placeholder="Korisničko ime">
            </div>
            <div >
                <input type="text"  id="email" name="email" placeholder="E-mail">
            </div>
            <div >
                <input type="password"  id="password" name="password" placeholder="Lozinka">
            </div>
            <div >
                <select  id="tip" name = "tip">
                    <option selected>Odaberi tip</option>
                    <option value="1">Moderator</option>
                    <option value="2">Korisnik</option>
      </select>
            </div>
            <br>
            <div >
                <button type="submit" name = "submit">Dodaj</button>
            </div>
    </form>
</div>

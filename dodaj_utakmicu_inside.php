<!-- select naziv from momcad where liga_id =$_SESSION[liga]  
method post
insert into utakmica momcad 1 , momcad 2, datum i vrijeme

-->

<?php
    require 'header.php'; 
    $veza=spojiSeNaBazu();


    if ( isset($_GET['liga_id']) ) { 
      $_SESSION['liga_id'] = $_GET['liga_id']; 
  }

  else {
      $_SESSION['liga_id']=0;
  }

  $ligaID=$_SESSION['liga_id']; 
?>

<div class="container"> 
                <form action="utakmica_dodana.php" method="post">
                        <?php
                           echo '<div>
                           <select id="momcad1" name = "momcad1">
                              ';

                          $upit =  "select momcad_id, naziv from momcad where liga_id = $ligaID;";
                          $rezultat = izvrsiUpit($veza,$upit);
                          while(list($id, $naziv)=mysqli_fetch_array($rezultat)) {

                                echo "<option value=\"$id\"\> $naziv</option>";
                               
                          }
                          echo '</select>';
                          echo '</div>';
                        ?>
                       <?php
                           echo '<div>
                           <select id="momcad2" name = "momcad2">
                              ';

                          $upit2 =  "select momcad_id, naziv from momcad where liga_id = $ligaID;"; 
                          $rezultat2 = izvrsiUpit($veza,$upit2);
                          while(list($id, $naziv)=mysqli_fetch_array($rezultat2)) {

                                echo "<option value=\"$id\"\>$naziv</option>"; 
                               
                          }
                          echo '</select>';
                          echo '</div>';
                        ?>

                      
                        <br>
                        <input placeholder= "Rezultat 1 (opcionalno)" name ="rezultat1" id ="rezultat1">
                        <br>
                        <input  placeholder= "Rezultat 2 (opcionalno)" name ="rezultat2" id ="rezultat2" >
                          <br>
                          <input type="text" name="datum" placeholder = "Datum početka"  name ="datum" id ="datum" required 
                            pattern="(?:30))|(?:(?:0[13578]|1[02])-31)).(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2]).(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])" >
                          <br>
                          <input type="text" placeholder = "Vrijeme početka"  name ="vrijeme" id ="vrijeme" required pattern="(([0-1]?[0-9])|(2[0-3])):[0-5][0-9]:[0-5][0-9]">
                          <br>
                    <input type="submit" name="submit" id = "submit"value="DODAJ">
                </form>
            </div>



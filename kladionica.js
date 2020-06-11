function dodajListic(utakmica_id,value) { 
    if(confirm("Jeste li sigurni da želite dodati listić? ")) { 
        window.location.href='dodaj.php?utakmica_id='+utakmica_id+'&value='+value;
        
        
        
        return true;
    }
}

function dodajRezultat(utakmica_id) {
    var rez1 = document.getElementById("rez1").value;
    var rez2 = document.getElementById("rez2").value;
    if(confirm("Jeste li sigurni da želite dodati rezultat? ")) {
        window.location.href='azuriraj_rez_inside.php?utakmica_id='+utakmica_id+'&rez1='+rez1+'&rez2='+rez2;
        return true;
    }
}


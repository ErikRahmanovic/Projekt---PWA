
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="registracija.css">
    <title>Registracija</title>
</head>
<style>
    footer {
    background-color: #333;
    text-align: center;
    padding: 10px;
    position: fixed;
    bottom: 0;
    width: 100%;
}

footer p {
    color: #fff; 
    margin: 0;
}
</style>
<body>
<header>
        <nav class="navbar main_nav" role="navigation">
            <ul class="main nav navbar-nav">
                <li>
                    <a href="index.php" class="">Početna</a>
                </li>
                <li>
                    <a href="kategorija.php?kategorija=sport" class="">Sport</a>
                </li>
                <li>
                    <a href="kategorija.php?kategorija=politika" class="">Politika</a>
                </li>
                <li>
                    <a href="administracija.php" class="">Administracija</a>
                </li>
                <li>
                    <a href="unos.php" class="">Unos</a>
                </li>
                <li>
                    <a href="registracija.php" class="">Registracija</a>
                </li>
            </ul>
        </nav>
    </header>

    <h1>Registracija novog korisnika</h1>
    <form action="registracija.php" method="post">
        <label for="username">Korisničko ime:</label>
        <input type="text" id="username" name="username" ><br><br>

        <label for="password">Lozinka:</label>
        <input type="password" id="password" name="password" ><br><br>

        <label for="firstname">Ime:</label>
        <input type="text" id="firstname" name="firstname" ><br><br>

        <label for="lastname">Prezime:</label>
        <input type="text" id="lastname" name="lastname" ><br><br>

        <label for="level">Razina korisnika:</label>
        <select id="level" name="level" required>
            <option value="0">Razina 0</option>
            <option value="1">Razina 1</option>
        </select><br><br>

        <input type="submit" value="Registriraj se">
    </form>

    </section>
<script type="text/javascript">
    document.getElementById("slanje").onclick = function(event) {
    var slanjeForme = true;
    
    var poljeIme = document.getElementById("ime");
    var ime = document.getElementById("ime").value;
    if (ime.length == 0) {
    slanjeForme = false;
    poljeIme.style.border="1px dashed red";
    document.getElementById("porukaIme").innerHTML="<br>Unesite ime!<br>";
    } else {
    poljeIme.style.border="1px solid green";
    document.getElementById("porukaIme").innerHTML="";
    }
    
    var poljePrezime = document.getElementById("prezime");
    var prezime = document.getElementById("prezime").value;
    if (prezime.length == 0) {
    slanjeForme = false;

    poljePrezime.style.border="1px dashed red";
    document.getElementById("porukaPrezime").innerHTML="<br>Unesite Prezime!<br>";
    } else {
    poljePrezime.style.border="1px solid green";
    document.getElementById("porukaPrezime").innerHTML="";
    }
    
    var poljeUsername = document.getElementById("username");
    var username = document.getElementById("username").value;
    if (username.length == 0) {
    slanjeForme = false;
    poljeUsername.style.border="1px dashed red";
    document.getElementById("porukaUsername").innerHTML="<br>Unesite korisničko ime!<br>";
    } else {
    poljeUsername.style.border="1px solid green";
    document.getElementById("porukaUsername").innerHTML="";
    }
    
    var poljePass = document.getElementById("pass");
    var pass = document.getElementById("pass").value;
    var poljePassRep = document.getElementById("passRep");
    var passRep = document.getElementById("passRep").value;
    if (pass.length == 0 || passRep.length == 0 || pass != passRep) {
    slanjeForme = false;
    poljePass.style.border="1px dashed red";
    poljePassRep.style.border="1px dashed red";
    document.getElementById("porukaPass").innerHTML="<br>Lozinke nisu iste!<br>";
    document.getElementById("porukaPassRep").innerHTML="<br>Lozinke nisu iste!<br>";
    } else {
    poljePass.style.border="1px solid green";
    poljePassRep.style.border="1px solid green";
    document.getElementById("porukaPass").innerHTML="";
    document.getElementById("porukaPassRep").innerHTML="";
    }
    if (slanjeForme != true) {
    event.preventDefault();
    }

};
</script>

<footer>
        <p> Erik Rahmanović 0035229813 </p>
    </footer>
</body>
</html>


<?php
include 'connect.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ime = $_POST['firstname'];
    $prezime = $_POST['lastname'];
    $username = $_POST['username'];
    $lozinka = $_POST['password'];
    $hashed_password = password_hash($lozinka, PASSWORD_DEFAULT); 

    
    $sql = "SELECT korisnicko_ime FROM korisnik WHERE korisnicko_ime = ?";
    $stmt = mysqli_stmt_init($dbc);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, 's', $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) > 0){
            $msg = 'Korisničko ime već postoji!';
        } else {
            
            $sql = "INSERT INTO korisnik (ime, prezime, korisnicko_ime, lozinka, razina) VALUES (?, ?, ?, ?, 0)";
            $stmt = mysqli_stmt_init($dbc);
            if (mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, 'ssss', $ime, $prezime, $username, $hashed_password);
                mysqli_stmt_execute($stmt);
                $registriranKorisnik = true;
            }
        }
        mysqli_stmt_close($stmt);
    }

    mysqli_close($dbc);

    
   
}
?>

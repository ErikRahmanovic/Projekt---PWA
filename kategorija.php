<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="kategorija.css">
    <title>Document</title>
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
    <footer>
        <p> Erik Rahmanović 0035229813 </p>
    </footer>
</body>
</html>
<?php
include 'connect.php';

if(isset($_GET['kategorija'])) { 
    $kategorija = $_GET['kategorija']; 

    $query = "SELECT * FROM vijesti WHERE arhiva=0 AND kategorija='$kategorija'";

    $result = mysqli_query($dbc, $query) or die('Error querying database.');

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo "<div style='margin-bottom: 20px;'>"; 
            echo "<h2 style='font-size: 24px;'>" . $row["naslov"]. "</h2>"; 

            
            $slika_putanja = 'slike/' . $row["slika"]; 
            if (!empty($row["slika"]) && file_exists($slika_putanja)) {
                echo "<img src='" . $slika_putanja. "' alt='Slika' style='max-width: 100%; height: auto;'>"; 
            } else {
                echo "<p>Slika nije dostupna.</p>";
            }

            echo "<p>" . $row["tekst"]. "</p>"; 
            echo "</div>"; 
        }
    } else {
        echo "Nema rezultata.";
    }
}
mysqli_close($dbc);
?>

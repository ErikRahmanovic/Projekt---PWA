<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="clanak.css">
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
define('UPLPATH', 'slike/');
$article_id = $_GET['id'];
$query = "SELECT * FROM vijesti WHERE id ='$article_id' AND arhiva=0";
$result = mysqli_query($dbc, $query) or die('Error querying database.');
$row = mysqli_fetch_assoc($result);
?>
<section role="main">
    <div class="row">
    <h2 class="category"><?php
        echo "<span>".$row['kategorija']."</span>";
    ?></h2>
    <h1 class="title"><?php
        echo $row['naslov'];
    ?></h1>
    <p>AUTOR:</p>
    <p>OBJAVLJENO: <?php
        echo "<span>".$row['datum']."</span>";
    ?></p>
    </div>
    <section class="slika">
    <?php
        echo '<img src="' . UPLPATH . $row['slika'] . '">';
    ?>
    </section>
    <section class="about">
    <p>
    <?php
        echo "<i>".$row['sazetak']."</i>";
    ?>
    </p>
    </section>
    <section class="sadrzaj">
    <p>
    <?php
    echo $row['tekst'];
    ?>
    </p>
</section>
</section>
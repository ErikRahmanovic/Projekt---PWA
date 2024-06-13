<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="unos.css">
    <title>News Submission Form</title>
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
        <nav class="navbar main_nav " role="navigation">
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
    <h1>Unos vijesti</h1>
    <form id="newsForm" action="unos.php" method="post" enctype="multipart/form-data">
        <label for="title">Naslov:</label><br>
        <input type="text" id="title" name="title"><br>
        <span id="porukaTitle" style="color: red;"></span><br><br>

        <label for="about">Sažetak:</label><br>
        <textarea id="about" name="about" rows="4" cols="50"></textarea><br>
        <span id="porukaAbout" style="color: red;"></span><br><br>

        <label for="content">Sadržaj:</label><br>
        <textarea id="content" name="content" rows="10" cols="50"></textarea><br>
        <span id="porukaContent" style="color: red;"></span><br><br>

        <label for="category">Kategorija:</label><br>
        <select id="category" name="category">
            <option value="">Odaberi kategoriju</option>
            <option value="sport">Sport</option>
            <option value="politika">Politika</option>
        </select><br>
        <span id="porukaKategorija" style="color: red;"></span><br><br>

        <label for="pphoto">Slika:</label><br>
        <input type="file" id="pphoto" name="pphoto" accept="image/*"><br>
        <span id="porukaSlika" style="color: red;"></span><br><br>

        <label for="archive">Arhiviraj:</label>
        <input type="checkbox" id="archive" name="archive"><br><br>

        <input type="submit" value="Submit" id="slanje">
    </form>

<script type="text/javascript">
    document.getElementById("slanje").onclick = function(event) {
        var slanjeForme = true;

        
        var title = document.getElementById("title").value.trim();
        if (title.length < 5 || title.length > 100) {
            slanjeForme = false;
            document.getElementById("porukaTitle").innerHTML = "Naslov vjesti mora imati između 5 i 30 znakova!<br>";
        } else {
            document.getElementById("porukaTitle").innerHTML = "";
        }

        
        var about = document.getElementById("about").value.trim();
        if (about.length < 10 || about.length > 300) {
            slanjeForme = false;
            document.getElementById("porukaAbout").innerHTML = "Kratki sadržaj mora imati između 10 i 100 znakova!<br>";
        } else {
            document.getElementById("porukaAbout").innerHTML = "";
        }

        
        var content = document.getElementById("content").value.trim();
        if (content.length === 0) {
            slanjeForme = false;
            document.getElementById("porukaContent").innerHTML = "Sadržaj mora biti unesen!<br>";
        } else {
            document.getElementById("porukaContent").innerHTML = "";
        }

        
        var category = document.getElementById("category").value;
        if (category === "") {
            slanjeForme = false;
            document.getElementById("porukaKategorija").innerHTML = "Morate odabrati kategoriju!<br>";
        } else {
            document.getElementById("porukaKategorija").innerHTML = "";
        }

        
        var pphoto = document.getElementById("pphoto").value.trim();
        if (pphoto.length === 0) {
            slanjeForme = false;
            document.getElementById("porukaSlika").innerHTML = "Slika mora biti unesena!<br>";
        } else {
            document.getElementById("porukaSlika").innerHTML = "";
        }

        if (!slanjeForme) {
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
    
    $picture = isset($_FILES['pphoto']['name']) ? $_FILES['pphoto']['name'] : '';
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $about = isset($_POST['about']) ? $_POST['about'] : '';
    $content = isset($_POST['content']) ? $_POST['content'] : '';
    $category = isset($_POST['category']) ? $_POST['category'] : '';
    $date = date('d.m.Y.');
    $archive = isset($_POST['archive']) ? 1 : 0;

    if ($picture && $title && $about && $content && $category) {
      
        $target_dir = 'slike/'.$picture;
        move_uploaded_file($_FILES["pphoto"]["tmp_name"], $target_dir);
        $query = "INSERT INTO Vijesti (datum, naslov, sazetak, tekst, slika, kategorija, arhiva)
                  VALUES ('$date', '$title', '$about', '$content', '$picture', '$category', '$archive')";
        $result = mysqli_query($dbc, $query) or die('Error querying database.');
        mysqli_close($dbc);

      
        
        exit();
    }
}
?>

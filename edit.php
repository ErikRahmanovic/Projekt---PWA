<?php
include 'connect.php';

define('UPLPATH', 'slike/');


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    
    $query = "SELECT * FROM vijesti WHERE id=$id";
    $result = mysqli_query($dbc, $query);
    
    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
    } else {
       
        echo "Article with ID=$id does not exist.";
        exit(); 
    }
}


if (isset($_POST['delete'])) {
    
    $id = $_POST['id'];
    $query = "DELETE FROM vijesti WHERE id=$id";
    mysqli_query($dbc, $query);
   
    header("Location: administracija.php"); 
    exit();
}

if (isset($_POST['update'])) {
   
    $id = $_POST['id'];
    $title = $_POST['title'];
    $about = $_POST['about'];
    $content = $_POST['content'];
    $category = $_POST['category'];
    $archive = isset($_POST['archive']) ? 1 : 0;

    $picture = $row['slika']; 
    if ($_FILES['pphoto']['name']) {
        $picture = $_FILES['pphoto']['name'];
        $target_dir = UPLPATH . $picture;
        move_uploaded_file($_FILES["pphoto"]["tmp_name"], $target_dir);
    }

    $query = "UPDATE vijesti SET naslov='$title', sazetak='$about', tekst='$content', slika='$picture', kategorija='$category', arhiva='$archive' WHERE id=$id";
    mysqli_query($dbc, $query);
    
    header("Location: administracija.php"); 
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="edit.css">
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
    
    <form method="POST" enctype="multipart/form-data">
        <div class="form-item">
            <label for="title">Naslov vijesti:</label>
            <div class="form-field">
                <input type="text" name="title" class="form-field-textual" value="<?php echo isset($row['naslov']) ? $row['naslov'] : ''; ?>">
            </div>
        </div>
        <div class="form-item">
            <label for="about">Kratki sadržaj vijesti (do 50 znakova):</label>
            <div class="form-field">
                <textarea name="about" cols="30" rows="10" class="form-field-textual"><?php echo isset($row['sazetak']) ? $row['sazetak'] : ''; ?></textarea>
            </div>
        </div>
        <div class="form-item">
            <label for="content">Sadržaj vijesti:</label>
            <div class="form-field">
                <textarea name="content" cols="30" rows="10" class="form-field-textual"><?php echo isset($row['tekst']) ? $row['tekst'] : ''; ?></textarea>
            </div>
        </div>
        <div class="form-item">
            <label for="pphoto">Slika:</label>
            <div class="form-field">
                <input type="file" class="input-text" id="pphoto" name="pphoto"> <br>
                <img src="<?php echo UPLPATH . (isset($row['slika']) ? $row['slika'] : ''); ?>" width="100px">
            </div>
        </div>
        <div class="form-item">
            <label for="category">Kategorija vijesti:</label>
            <div class="form-field">
                <select name="category" class="form-field-textual">
                    <option value="sport" <?php echo (isset($row['kategorija']) && $row['kategorija'] == 'sport') ? 'selected' : ''; ?>>Sport</option>
                    <option value="politika" <?php echo (isset($row['kategorija']) && $row['kategorija'] == 'politika') ? 'selected' : ''; ?>>Politika</option>
                </select>
            </div>
        </div>
        <div class="form-item">
            <label>Spremiti u arhivu:</label>
            <div class="form-field">
                <input type="checkbox" name="archive" id="archive" <?php echo (isset($row['arhiva']) && $row['arhiva'] == 1) ? 'checked' : ''; ?>> Arhiviraj
            </div>
        </div>
        <div class="form-item">
            <input type="hidden" name="id" value="<?php echo isset($row['id']) ? $row['id'] : ''; ?>">
            <button type="reset" value="Poništi">Poništi</button>
            <button type="submit" name="update" value="Prihvati">Izmjeni</button>
            <button type="submit" name="delete" value="Izbriši">Izbriši</button>
        </div>
    </form>
    <footer>
        <p> Erik Rahmanović 0035229813 </p>
    </footer>
</body>
</html>

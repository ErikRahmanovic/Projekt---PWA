<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="administracija.css">
    <title>Document</title>
    
    <style>
        table {
            margin: 0 auto;
        }
        h1 {
    text-align: center; 
}
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


    <script>
        function confirmDelete(event) {
            if (!confirm('Jeste li sigurni da želite obrisati ovu vijest?')) {
                event.preventDefault();
            }
        }
    </script>

</head>

<body>
<header>
        <nav class="navbar">
            <ul>
                <li>
                    <a href="index.php">Početna</a>
                </li>
                <li>
                    <a href="kategorija.php?kategorija=sport">Sport</a>
                </li>
                <li>
                    <a href="kategorija.php?kategorija=politika">Politika</a>
                </li>
                <li>
                    <a href="administracija.php">Administracija</a>
                </li>
                <li>
                    <a href="unos.php">Unos</a>
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
session_start();
include 'connect.php'; 
define('UPLPATH', 'img/');


if (isset($_SESSION['username'])) {
    

   
    $query = "SELECT * FROM vijesti";
    $result = mysqli_query($dbc, $query);

    echo '<h1>Administracija korisnika</h1>';
    echo '<table  border="1">
          <tr>
            <th>Naslov</th>
            <th></th>
          </tr>';

    while ($row = mysqli_fetch_array($result)) {
        echo '<tr>';
        echo '<td>' . $row['naslov'] . '</td>';
        echo '<td><a href="edit.php?id=' . $row['id'] . '">Uredi</a> | <a href="delete.php?id=' . $row['id'].' "onclick="confirmDelete(event)" >Obriši</a></td>';
        echo '</tr>';
    }

    echo '</table>';

    
} else {
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Provjera korisničkih podataka
        $query = "SELECT * FROM korisnik WHERE korisnicko_ime = ?";
        $stmt = mysqli_prepare($dbc, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 's', $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
    
            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                $stored_password = $row['lozinka'];
    
                if (password_verify($password, $stored_password)) {
                         
                  $_SESSION['username'] = $username;

                             
                 header('Location: administracija.php');
            exit;
                } else {
                   
                    echo '<p>Pogrešno korisničko ime ili lozinka. Molimo pokušajte ponovno.</p>';
                }
            } else {
               
                 echo '<p>Pogrešno korisničko ime ili lozinka. Molimo pokušajte ponovno.</p>';
            }
    
            mysqli_stmt_close($stmt);
        } else {
            echo  "Greška prilikom pripreme upita: " . mysqli_error($dbc);
        }
    
       
    }

    
    echo '<h2>Prijava</h2>';
    echo '<form action="" method="post">
          <label>Korisničko ime:</label> <input type="text" name="username"><br>
          <label>Lozinka:</label> <input type="password" name="password"><br>
          <input type="submit" value="Prijava">
          </form>';

    
    echo '<br><a href="registracija.php">Registracija</a>';
}

mysqli_close($dbc); 
?>


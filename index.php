<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="index1.css">
    <style>
     
        .section {
            width: 100%;
            margin-bottom: 20px;
            box-sizing: border-box;
        }
        .section-header {
            text-align: center;
            margin-bottom: 10px;
        }
        .article-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }
        .article {
            width: calc(33.33% - 20px);
            margin-bottom: 20px;
            padding: 10px;
            box-sizing: border-box;
        }
        .article img {
            width: 100%;
            height: auto;
        }
        .media_body {
            text-align: center;
        }
        .title {
            margin-top: 10px;
            font-size: 18px;
        }
        @media (max-width: 768px) {
            .article {
                width: 100%; 
            }
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
    <title>Document</title>
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

    <div class="section">
        <h2 class="section-header">Sport</h2>
        <div class="article-container">
            <?php
            include 'connect.php';
            define('UPLPATH', 'slike/');

            $query_sport = "SELECT * FROM vijesti WHERE arhiva = 0 AND kategorija = 'sport' LIMIT 3";
            $result_sport = mysqli_query($dbc, $query_sport);
            while ($row_sport = mysqli_fetch_array($result_sport)) {
                echo '<div class="article">';
                echo '<img src="' . UPLPATH . $row_sport['slika'] . '" alt="Sport Image">';
                echo '<div class="media_body">';
                echo '<h4 class="title"><a href="clanak.php?id=' . $row_sport['id'] . '">' . $row_sport['naslov'] . '</a></h4>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>

    <div class="section">
        <h2 class="section-header">Politika</h2>
        <div class="article-container">
            <?php
            $query_politika = "SELECT * FROM vijesti WHERE arhiva = 0 AND kategorija = 'politika' LIMIT 3";
            $result_politika = mysqli_query($dbc, $query_politika);
            while ($row_politika = mysqli_fetch_array($result_politika)) {
                echo '<div class="article">';
                echo '<img src="' . UPLPATH . $row_politika['slika'] . '" alt="Politika Image">';
                echo '<div class="media_body">';
                echo '<h4 class="title"><a href="clanak.php?id=' . $row_politika['id'] . '">' . $row_politika['naslov'] . '</a></h4>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
    <footer>
        <p> Erik Rahmanović 0035229813 </p>
    </footer>
</body>
</html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/scorers.css">
    <title>11Champions</title>
</head>
<body>
<header>
    <nav>
        <div class="nav-menu">
            <a href="index.html" id="logo">1<span>1</a>
            <div class="menu-desktop">
                <ul>
                    <a href="leaderboards.php"><li>CLASSIFICAÇÃO</li></a>
                    <a href="/"><li>ÚLTIMOS RESULTADOS</li></a>
                    <a href="/"><li>CALENDÁRIO</li></a>
                    <a href="scorers.php"><li>MARCADORES</li></a>
                </ul>
            </div>
        </div>
    </nav>
</header>

<main>
    <div class="container">
        <h1>MARCADORES</h1>

        <?php

        $str = "dbname=11test user=postgres password=postgres host=localhost port=5432";
        $conn = pg_connect($str);
        $result = pg_query($conn, " SELECT  *  FROM player;");


        while ($row = pg_fetch_assoc($result) ){
            echo
                "
                 <div class='player-stats'>
                    <div class='player-info'>
                        <h2>".$row['name']."</h2>
                        <h4>".$row['team']."</h4>
                        <p>".$row['position']."</p>
                    </div>
                    <div class='player-goals'>
                        <h1>".$row['goals']."</h1>
                    </div>
                 </div>
                "
            ;
        }
        ?>
    </div>
</main>
<footer>

</footer>
</body>
</html>
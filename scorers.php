<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/scorers.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/myscript.js"></script>
    <title>Marcadores</title>
</head>
<body>
<header>
    <?php
    include 'header.php';
    ?>
</header>

<main>
    <div class="container">
        <h1>MARCADORES</h1>

        <?php

        $str = "dbname=11champions user=postgres password=postgres host=localhost port=5432";
        $conn = pg_connect($str) or die("Erro na ligação");
        $result = pg_query($conn, " SELECT  *  FROM player;");


        while ($row = pg_fetch_assoc($result) ){
            echo
                "
                 <div class='player-stats'>
                    <div class='player-info'>
                        <h2>".$row['name']."</h2>
                        <p>".$row['age']."</p>
                        <p>".$row['position']."</p>
                    </div>
                    <div class='player-goals'>
                        <h1>0</h1>
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
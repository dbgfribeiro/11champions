<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="../image/png" sizes="32x32" href="../img/favicon-32x32.png">
    <link rel="icon" type="../image/png" sizes="16x16" href="../img/favicon-16x16.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/scorers.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/myscript.js"></script>
    <title>admin_Marcadores</title>
</head>
<body>
<header>
    <?php
    include 'header_admin.php';
    ?>
</header>

<main>

    <?php
    echo "<a id='logout' href='../index.php'>Sair</a>";
    ?>


    <div class="container">
        <h1>MARCADORES</h1>

        <?php

        $str = "dbname=11champions user=postgres password=postgres host=localhost port=5432";
        $conn = pg_connect($str) or die("Erro na ligação");
        $result = pg_query($conn, " SELECT  *  FROM player ORDER BY name ASC;");

        /*players organized by name asc bc there is no goals scored yet*/

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
                ";
        }
        ?>
    </div>
</main>

</body>
</html>
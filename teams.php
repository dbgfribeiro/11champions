<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/teams.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/myscript.js"></script>
    <title>Equipas</title>
</head>
<body>
<header>
    <?php
    include 'header.php';
    ?>
</header>

<main>

    <?php
        echo "<a id='logout' href='index.php'>Entrar</a>";
    ?>

    <div class="container">
        <h1>EQUIPAS</h1>

        <?php

        $str = "dbname=11champions user=postgres password=postgres host=localhost port=5432";
        $conn = pg_connect($str);


        /*----------get table teams info-----------*/
        $teamsResult = pg_query($conn, "SELECT teams.name as team_name , teams.id as team_id, matches_played from teams");

        while ($row = pg_fetch_assoc($teamsResult) ){
            
            $logo_src = 0;
            include 'logos_loader.php';
            echo   "

            <div class='team-container'>



                <div class='team-info'>
                    <div class='team-desc'>
                    <h2>".$row['team_name']."</h2>
                    <p>Nº de jogos: ".$row['matches_played']." </p>
                    </div>
                    <a id='open' href='#'>+</a>
                    <img src=".$logo_src." alt='team-logo'>
                </div>
               
                <div class='team-players' id='players'>
                ";



            /*----------get position 'Avançado' from player-----------*/
            $avancadoResult = pg_query($conn, "SELECT player.name as player_name , position, age 
                                                    from player
                                                    where teams_id='$row[team_id]' and position='Avançado'
                                                    order by player_name asc ");
            echo "<ul>";
            echo "<h3>Avançados</h3>";
            while ($playerRow = pg_fetch_assoc($avancadoResult) ){
                echo "<li>".$playerRow['player_name']." <br><span>".$playerRow['age']." anos</span></li>";
            }
            echo "</ul>";



            /*----------get position 'Médio' from player-----------*/
            $medioResult = pg_query($conn, "SELECT player.name as player_name , position, age 
                                                    from player
                                                    where teams_id='$row[team_id]' and position='Médio'
                                                    order by player_name asc ");
            echo "<ul>";
            echo "<h3>Médios</h3>";
            while ($playerRow = pg_fetch_assoc($medioResult) ){
                echo "<li>".$playerRow['player_name']." <br><span>".$playerRow['age']." anos</span></li>";
            }
            echo "</ul>";



            /*----------get position 'Defesa' from player-----------*/
            $defesaResult = pg_query($conn, "SELECT player.name as player_name , position, age 
                                                    from player
                                                    where teams_id='$row[team_id]' and position='Defesa'
                                                    order by player_name asc ");
            echo "<ul>";
            echo "<h3>Defesas</h3>";
            while ($playerRow = pg_fetch_assoc($defesaResult) ){
                echo "<li>".$playerRow['player_name']." <br><span>".$playerRow['age']." anos</span></li>";
            }
            echo "</ul>";



            /*----------get position 'Guarda Redes' from player-----------*/
            $grResult = pg_query($conn, "SELECT player.name as player_name , position, age 
                                                    from player
                                                    where teams_id='$row[team_id]' and position='Guarda Redes'
                                                    order by player_name asc ");
            echo "<ul>";
            echo "<h3>Guarda Redes</h3>";
            while ($playerRow = pg_fetch_assoc($grResult) ){
                echo "<li>".$playerRow['player_name']." <br><span>".$playerRow['age']." anos</span></li>";
            }
            echo "</ul>";


            echo "
                </div>
            </div>
          ";
        }

        ?>


    </div>
</main>
<footer>

</footer>
<script src="js/myscript.js"></script>
</body>
</html>
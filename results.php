<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/results.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/myscript.js"></script>
    <title>Últimos Resultados</title>
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
        <h1>ÚLTIMOS RESULTADOS</h1>

        <?php

            $str = "dbname=11champions user=postgres password=postgres host=localhost port=5432";
            $conn = pg_connect($str);
            error_reporting(0);


            $rounds=pg_query($conn, "SELECT MAX(round) AS all FROM matches") or die;
            $row = pg_fetch_array( $rounds );
            $allRounds = $row['all'];

            $homeTeam = pg_query($conn, "SELECT teams.name from teams, matches WHERE teams.id = matches.teams_id") or die;
            $awayTeam = pg_query($conn, "SELECT teams.name from teams, matches WHERE teams.id = matches.teams_id1") or die;
            
            echo "
            <div class='rounds'>
            ";
            for($i=1; $i<$allRounds+1; $i++){
                    $roundResult = pg_query($conn, "SELECT * FROM matches WHERE round='$i' AND goal_t1 IS NOT NULL AND goal_t2 IS NOT NULL") or die;
                    $allMatches=pg_affected_rows($roundResult);
                    
                    echo "
                        <div class='round' id='round'>
                            <h2>".$i."ª Jornada</h2>";
                        for ($j=0; $j<$allMatches; $j++) {
                            $home = pg_fetch_array($homeTeam);
                            $away = pg_fetch_array($awayTeam);
                            $row_jornada=pg_fetch_assoc($roundResult);
                        echo "
                            <div class='match'>
                                <p>".$home['name']."</p>
                                <div class='result'>
                                    <h3>".$row_jornada['goal_t1']."</h3>
                                    <h3>:</h3>
                                    <h3>".$row_jornada['goal_t2']."</h3>
                                </div>
                                <p>".$away['name']."</p>
                            </div>
                            ";
                }
                echo "</div>";
                
            }
            echo "
            </div>
            ";
            pg_close($conn);
        ?>
    </div>
</main>
<script src="js/calendar.js"></script>
</body>
</html>
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


            $rounds = pg_query($conn, "SELECT MAX(round) AS all FROM matches") or die;
            $row = pg_fetch_array( $rounds );
            $allRounds = $row['all'];
            
            echo "
            <div class='rounds'>
            ";

            for($i=1; $i<$allRounds+1; $i++){
                    $roundResult = pg_query($conn, "SELECT * FROM matches
                                                    WHERE round='$i'
                                                    AND goal_t1 IS NOT NULL
                                                    AND goal_t2 IS NOT NULL
                                                    ORDER BY day ASC") or die;
                    //displays all rounds
                    echo "
                        <div class='round' id='round'>
                            <h2>".$i."ª Jornada</h2>";

                        while ($rowRound = pg_fetch_assoc($roundResult)) {
                            $homeTeam = pg_query($conn, "SELECT teams.name , teams.id AS t_id FROM teams, matches WHERE $rowRound[teams_id] = teams.id") or die;
                            $awayTeam = pg_query($conn, "SELECT teams.name , teams.id AS t_id FROM teams, matches WHERE $rowRound[teams_id1] = teams.id") or die;
                            $home = pg_fetch_array($homeTeam);
                            $away = pg_fetch_array($awayTeam);
                            $home = pg_fetch_array($homeTeam);
                            $away = pg_fetch_array($awayTeam);

                        //displays all matches per round   
                        echo "
                            <div class='match'>
                                <div class='match-info'>
                                    <p>".date("d/m", strtotime($rowRound['day']))."</p>
                                    <h4>".$home['name']."</h4>
                                    <div class='result'>
                                        <h3>".$rowRound['goal_t1']."</h3>
                                        <h3>:</h3>
                                        <h3>".$rowRound['goal_t2']."</h3>
                                    </div>
                                    <h4>".$away['name']."</h4>
                                </div>

                                <div class='match-stats'>";

                                $goalsResult = pg_query($conn, "SELECT player.name AS pname , player.teams_id AS teamid , goals.minute AS goal
                                                                FROM player, goals
                                                                WHERE player.id = goals.player_id
                                                                AND goals.matches_id= '$rowRound[id]'
                                                                ORDER BY goal ASC") or die;

                                //displays all goals per match and respective scorers and minutes
                                while ($goal = pg_fetch_assoc($goalsResult) ){

                                    if($goal['teamid'] == $home['t_id']){
                                    echo"
                                        <div class='goal g-home'>
                                            <p>".$goal['pname']."</p>
                                            <h4>min ".$goal['goal']."'</h4>
                                        </div>
                                        ";
                                    }
                                    else if($goal['teamid'] == $away['t_id']){
                                    echo"
                                        <div class='goal g-away'>
                                            <h4>min ".$goal['goal']."'</h4>
                                            <p>".$goal['pname']."</p>
                                        </div>
                                        ";
                                    }
                                       
                                }
                                echo"
                                </div>
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
<script src="js/mainscript.js"></script>
<script src="js/calendar.js"></script>
</body>
</html>
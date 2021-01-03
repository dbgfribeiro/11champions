<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="../image/png" sizes="32x32" href="../img/favicon-32x32.png">
    <link rel="icon" type="../image/png" sizes="16x16" href="../img/favicon-16x16.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/results.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>admin_Últimos Resultados</title>
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
        <h1>ÚLTIMOS RESULTADOS</h1>


    <?php

        $str = "dbname=11champions user=postgres password=postgres host=localhost port=5432";
        $conn = pg_connect($str);
        error_reporting(0);


        $rounds = pg_query($conn, "SELECT MAX(round) AS all FROM matches") or die;
        $row = pg_fetch_array( $rounds );
        $allRounds = $row['all'];



        echo "
        <div class='rounds rounds-admin'>
        ";


        for($i=1; $i<$allRounds+1; $i++){
                $roundResult = pg_query($conn, "SELECT * FROM matches
                                                WHERE round='$i'
                                                AND day <= CURRENT_DATE
                                                ORDER BY day ASC") or die;
                                                
                //displays all rounds
                echo "
                    <div class='round round-admin' id='round'>
                        <h2>".$i."ª Jornada</h2>";


                while ($rowRound = pg_fetch_assoc($roundResult)) {
                    $homeTeam = pg_query($conn, "SELECT teams.name , teams.id AS t_id FROM teams, matches WHERE $rowRound[teams_id] = teams.id") or die;
                    $awayTeam = pg_query($conn, "SELECT teams.name , teams.id AS t_id FROM teams, matches WHERE $rowRound[teams_id1] = teams.id") or die;
                    $home = pg_fetch_array($homeTeam);
                    $away = pg_fetch_array($awayTeam);


                    //displays all matches per round 
                    echo "
                        <div class='match'>
                        <div class='match-info'> 
                            <p>".date("d/m", strtotime($rowRound['day']))."</p>
                            <h4>".$home['name']."</h4>
                            <div class='result'>";
                            
                            if($rowRound['goal_t1'] == NULL || $rowRound['goal_t2'] == NULL){
                            echo"
                            
                                <form method='POST' action='admin_addmatch.php'>
                                    <input type='number' name='hgoal' min='0' required>
                                    <h3>:</h3>
                                    <input type='number' name='agoal' min='0' required>
                                    <button type='submit' value='$rowRound[id]' name='sub'>></button>
                                </form>";
                            }
                            else{
                            echo"
                                <form method='POST' action='admin_addmatch.php'>
                                    <input type='number' name='hgoal' placeholder='".$rowRound['goal_t1']."' min='0' required>
                                    <h3>:</h3>
                                    <input type='number' name='agoal' placeholder='".$rowRound['goal_t2']."' min='0' required>
                                    <button type='submit' value='$rowRound[id]' name='sub'>></button>
                                </form>";
                            }
                            echo"
                                </div>
                              <h4>".$away['name']."</h4>
                            </div>

                            <div class='match-stats'>";

                            $goalsResult = pg_query($conn, "SELECT player.id AS pid,
                            player.name AS pname,
                            player.teams_id AS teamid,
                            goals.matches_id AS mid,
                            goals.minute AS goal
                            FROM player, goals
                            WHERE player.id = goals.player_id
                            AND goals.matches_id = '$rowRound[id]'
                            ORDER BY goal ASC") or die;
                        

                            //form to add scorer
                            if($rowRound['goal_t1'] != NULL || $rowRound['goal_t2'] != NULL){
                                echo"
                                <form method='POST' action='admin_addmatch.php'>
                                    <select name='pname' required>
                                    <option disabled value='' selected>Marcador</option>";
                                    $addPlayer = pg_query($conn, "SELECT player.name AS scorer , player.id AS scorerid
                                    FROM player
                                    WHERE player.teams_id = $rowRound[teams_id]
                                    OR player.teams_id = $rowRound[teams_id1]
                                    ORDER BY scorer ASC");
                                    while ($rowPlayer = pg_fetch_assoc($addPlayer) ) {
                                        echo "<option value='".$rowPlayer['scorerid']."'>".$rowPlayer['scorer']."</option>";
                                    }
                                echo"
                                    </select>
                                    <input type='number' name='minute' placeholder='Minuto' min='0' required>
                                    <button type='submit' value='$rowRound[id]' name='add'>Adicionar</button>
                                </form>
                                ";
                            }


                            //displays all goals per match  
                            while ($goal = pg_fetch_assoc($goalsResult) ){

                                if($goal['teamid'] == $home['t_id']){
                                echo"
                                    <div class='goal g-home'>
                                        <p>".$goal['pname']."</p>
                                        <h4>min ".$goal['goal']."'</h4>
                                        <a id='delete' href='admin_addmatch.php?rp=$goal[pid]&&rpm=$goal[mid]'>x</a>
                                    </div>
                                    ";
                                }
                                else if($goal['teamid'] == $away['t_id']){
                                    echo"
                                    <div class='goal g-away'>
                                        <h4>min ".$goal['goal']."'</h4>
                                        <p>".$goal['pname']."</p>
                                        <a id='delete' href='admin_addmatch.php?rp=$goal[pid]&&rpm=$goal[mid]'>x</a>
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
<script src="../js/myscript.js"></script>
<script src="../js/calendar.js"></script>
</body>
</html>
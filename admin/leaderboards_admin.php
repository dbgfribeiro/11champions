<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="../image/png" sizes="32x32" href="../img/favicon-32x32.png">
    <link rel="icon" type="../image/png" sizes="16x16" href="../img/favicon-16x16.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/leaderboards.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/myscript.js"></script>
    <title>admin_Classificações</title>
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
        <h1>CLASSIFICAÇÕES</h1>

        <?php
        $str = "dbname=11champions user=postgres password=postgres host=localhost port=5432";
        $conn = pg_connect($str);

        //order by chosen category
        if(isset($_GET['category'])){
                $category = $_GET['category'];
        }
        //default order is by points
        else{
                $category = 'points';
        }

        //changes order between DESC and ASC on click
        if(isset($_GET['order'])){
                $order = $_GET['order'];
        }
        else{
                $order = 'DESC';
        }
        $rowCount = 1;
        $leaderboards = pg_query($conn, " SELECT  *  FROM leaderboards, teams
                                        WHERE leaderboards.teams_id = teams.id
                                        ORDER BY $category $order");

        if(pg_num_rows($leaderboards) > 0){

                //reads clicks to toggle between order ASC and DESC
                $order == 'DESC' ? $order = 'ASC' : $order = 'DESC';

                echo "
                <table>
                    <tr>
                        <th>#</th>
                        <th><a href='?category=name&&order=$order'>Equipa</a></th>
                        <th><a href='?category=points&&order=$order'>P</a></th>
                        <th><a href='?category=matches_played&&order=$order'>NºJ</a></th>
                        <th><a href='?category=wins&&order=$order'>V</a></th>
                        <th><a href='?category=draws&&order=$order'>E</a></th>
                        <th><a href='?category=loses&&order=$order'>D</a></th>
                        <th><a href='?category=g_scored&&order=$order'>GM</a></th>
                        <th><a href='?category=g_conceed&&order=$order'>GS</a></th>
                    </tr>";


        while ($row = pg_fetch_assoc($leaderboards) ){

                echo   "
                    <tr>
                        <td>".$rowCount++."</td>
                        <td>".$row['name']."</td>
                        <td>".$row['points']."</td>
                        <td>".$row['matches_played']."</td>
                        <td>".$row['wins']."</td>
                        <td>".$row['draws']."</td>
                        <td>".$row['loses']."</td>
                        <td>".$row['g_scored']."</td>
                        <td>".$row['g_conceed']."</td>
                    </tr>";
                }
                echo  "</table>";
        }

                echo "
                <div class='leaderboard-edit'>
                    <form method='get'>
                        <input id='clear' type='submit' name='clear' value='Limpar' onclick='refresh()'/>
                        <input type='submit' name='update' value='Atualizar'/>
                    </form>
                </div>
                ";
                ?>


        <?php

        $str = "dbname=11champions user=postgres password=postgres host=localhost port=5432";
        $conn = pg_connect($str);


        $rounds = pg_query($conn, "SELECT MAX(round) AS all FROM matches") or die;
        $row = pg_fetch_array( $rounds );
        $allRounds = $row['all'];




        for($i=1; $i<$allRounds+1; $i++){
            
                $roundResult = pg_query($conn, "SELECT * FROM matches WHERE round='$i' AND goal_t1 IS NOT NULL AND goal_t2 IS NOT NULL") or die;                        

                    while ($row_round = pg_fetch_assoc($roundResult)) {

                        $team1 = pg_query($conn, "SELECT * FROM leaderboards, matches WHERE leaderboards.teams_id = $row_round[teams_id]");
                        $team1result = pg_fetch_array($team1);

                        $team2 = pg_query($conn, "SELECT * FROM leaderboards, matches WHERE leaderboards.teams_id = $row_round[teams_id1] ");
                        $team2result = pg_fetch_array($team2);
                    
 
                        $team1Goal = $team1result['g_scored']+$row_round['goal_t1'];
                        $team1GoalC = $team1result['g_conceed']+$row_round['goal_t2'];

                        $team2Goal = $team2result['g_scored']+$row_round['goal_t2'];
                        $team2GoalC = $team2result['g_conceed']+$row_round['goal_t1'];



                        if(isset($_GET['update'])){
                            
                            if($row_round['goal_t1'] > $row_round['goal_t2']){

                                $team1wins = $team1result['wins']+1;
                                $leaderboardT1Update = pg_query($conn, "UPDATE leaderboards
                                                                        SET wins = $team1wins,
                                                                        g_scored = $team1Goal,
                                                                        g_conceed = $team1GoalC
                                                                        WHERE teams_id = $row_round[teams_id]");                                   
                            
                                $team2loses = $team2result['loses']+1;
                                $leaderboardT2Update = pg_query($conn, "UPDATE leaderboards
                                                                        SET loses = $team2loses,
                                                                        g_scored = $team2Goal,
                                                                        g_conceed = $team2GoalC
                                                                        WHERE teams_id = $row_round[teams_id1]");  
                            }


                            if($row_round['goal_t1'] == $row_round['goal_t2']){

                                $team1draws = $team1result['draws']+1;
                                $leaderboardT1Update = pg_query($conn, "UPDATE leaderboards
                                                                        SET draws = $team1draws,
                                                                        g_scored = $team1Goal,
                                                                        g_conceed = $team1GoalC
                                                                        WHERE teams_id = $row_round[teams_id]");         

                                $team2draws = $team2result['draws']+1;
                                $leaderboardT2Update = pg_query($conn, "UPDATE leaderboards
                                                                        SET draws = $team2draws,
                                                                        g_scored = $team2Goal,
                                                                        g_conceed = $team2GoalC
                                                                        WHERE teams_id = $row_round[teams_id1]");
                            }


                            if($row_round['goal_t1'] < $row_round['goal_t2']){
                            
                                $team2wins = $team2result['wins']+1;
                                $leaderboardT2Update = pg_query($conn, "UPDATE leaderboards
                                                                        SET wins = $team2wins,
                                                                        g_scored = $team2Goal,
                                                                        g_conceed = $team2GoalC
                                                                        WHERE teams_id = $row_round[teams_id1]");                                   
                            
                                $team1loses = $team1result['loses']+1;
                                $leaderboardT1Update = pg_query($conn, "UPDATE leaderboards
                                                                        SET loses = $team1loses,
                                                                        g_scored = $team1Goal,
                                                                        g_conceed = $team1GoalC
                                                                        WHERE teams_id = $row_round[teams_id]");  
                            }

                            
                            $pointsUpdate = pg_query($conn, "UPDATE leaderboards
                                                            SET points = (wins*3 + draws)
                                                            WHERE teams_id IN (1,2,3,4,5,6,7,8)");


                            $teamsUpdate = pg_query($conn, "UPDATE teams
                                                            SET matches_played = (leaderboards.wins + leaderboards.loses + leaderboards.draws)
                                                            FROM leaderboards
                                                            WHERE leaderboards.teams_id = teams.id");   

                    }

                    else if(isset($_GET['clear'])){
                        $leaderboardReset = pg_query($conn, "UPDATE leaderboards
                        SET wins = 0, 
                            loses = 0,
                            draws = 0,
                            g_scored = 0,
                            g_conceed = 0,
                            points = 0
                        WHERE teams_id IN (1,2,3,4,5,6,7,8)");

                        $teamsReset = pg_query($conn, "UPDATE teams
                        SET matches_played = 0
                        WHERE id IN (1,2,3,4,5,6,7,8)");       

                    }
            }
            
        }
    pg_close($conn);    
    ?>
    </div>
</main>

<script>    
    if(typeof window.history.pushState == 'function') {
        window.history.pushState({}, "Hide", "leaderboards_admin.php");
    }

</script>

</body>
</html>
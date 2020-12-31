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
    <script src="../js/myscript.js"></script>
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

        $homeTeam = pg_query($conn, "SELECT teams.name from teams, matches WHERE teams.id = matches.teams_id") or die;
        $awayTeam = pg_query($conn, "SELECT teams.name from teams, matches WHERE teams.id = matches.teams_id1") or die;

        echo "
        <div class='rounds rounds-admin'>
        ";


        for($i=1; $i<$allRounds+1; $i++){
                $roundResult = pg_query($conn, "SELECT * FROM matches WHERE round='$i' AND day <= CURRENT_DATE ") or die;
                $allMatches=pg_affected_rows($roundResult);
                
                echo "
                    <div class='round round-admin' id='round'>
                        <h2>".$i."ª Jornada</h2>";
                    for ($j=0; $j<$allMatches; $j++) {
                        $home = pg_fetch_array($homeTeam);
                        $away = pg_fetch_array($awayTeam);
                        $row_jornada=pg_fetch_assoc($roundResult);
                    echo "
                        <div class='match'>
                            <p>".$home['name']."</p>

                            <div class='result'>";
                            if($row_jornada['goal_t1'] == NULL || $row_jornada['goal_t2'] == NULL){
                            echo"
                                <form method='get'>
                                    <input type='number' name='hgoal' min='0'>
                                    <h3>:</h3>
                                    <input type='number' name='agoal' min='0'>
                                </form>";
                            }
                            else{
                                echo"
                                    <form method='get'>
                                        <input type='number' name='hgoal' placeholder='".$row_jornada['goal_t1']."' min='0'>
                                        <h3>:</h3>
                                        <input type='number' name='agoal' placeholder='".$row_jornada['goal_t2']."' min='0'>
                                    </form>";
                            }
                            echo"
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
<script src="../js/calendar.js"></script>
</body>
</html>
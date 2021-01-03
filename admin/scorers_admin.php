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

        $goalResult = pg_query($conn, " SELECT player.teams_id AS tid, player.position AS pos, player.name AS pname,
                                        COUNT(goals.player_id) AS ngoals
                                        FROM player
                                        LEFT JOIN goals ON goals.player_id = player.id
                                        GROUP BY player.teams_id, player.position, player.name
                                        ORDER BY ngoals DESC");
                                        //import all goals from respective scorers



        echo "
        <div class='scorers-container'>";
        while ($row = pg_fetch_assoc($goalResult) ){

            $teamResult = pg_query($conn, "SELECT teams.name AS tname FROM teams, player WHERE $row[tid] = teams.id") or die;
            $team = pg_fetch_array($teamResult);
            //import teams from all scorers

            if($row['ngoals'] >= 1){
            echo
                "
                <div class='player-stats'>
                    <div class='player-info'>
                        <h2>".$row['pname']."</h2>
                        <p>".$row['pos']."</p>
                        <h3>".$team['tname']."</h3>
                    </div>
                    <div class='player-goals'>
                        <h1>".$row['ngoals']."</h1>
                        <p>golos</p>
                    </div>
                </div>
                ";
            }
        }
        echo "</div>";
        ?>
    </div>
</main>

<script src="../js/mainscript.js"></script>

</body>
</html>
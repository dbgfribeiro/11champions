<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <div class="container">
        <h1>EQUIPAS</h1>

        <?php
        /*
        $str = "dbname=11champions user=postgres password=postgres host=localhost port=5432";
        $conn = pg_connect($str);

        $teamResource = pg_query($conn, "SELECT count(*) AS exact_count FROM teams");
        $teamCount = pg_fetch_result($teamResource, 0, 0);

        $playerResource = pg_query($conn, "SELECT count(*) AS exact_count FROM player where teams_id = 1");
        $playerCount = pg_fetch_result($playerResource, 0, 0);


        for ($i = 0; $i < $teamCount; $i++) {
            $TEAMNAME = pg_query($conn, "SELECT name FROM teams");
            $ALLTEAMS[$i] = pg_fetch_result($TEAMNAME, $i, 0);
            $MATCH = pg_query($conn, "SELECT matches_played FROM teams");
            $ALLMATCHES[$i] = pg_fetch_result($MATCH, $i, 0);
        }
        for ($j = 0; $j < $playerCount; $j++) {
            $PLAYERNAME = pg_query($conn, "SELECT name FROM player");
            $ALLPLAYERS[$j] = pg_fetch_result($PLAYERNAME, $j, 0);
        }
        $optionString = '';
        for ($i = 0; $i < $teamCount; $i++) {
            echo   "
                    <div class='team-container'>
                        <div class='team-info'>
                            <h2>".$ALLTEAMS[$i]."</h2>
                            <p>Nº de Jogos: ".$ALLMATCHES[$i]."</p>
                        </div>
                        <img src='' alt='team-logo'>
                    </div>
                    <div class='team-players'>
                    <ul>";
                     for ($j = 0; $j < $playerCount; $j++) {
                     echo"
                        <li>".$ALLPLAYERS[$j]."</li>
                        ";
                     }
                    echo" </ul>
                    </div>
                ";

        }


        */

        $str = "dbname=11champions user=postgres password=postgres host=localhost port=5432";
        $conn = pg_connect($str);

        $teamsResult = pg_query($conn, "SELECT name, matches_played FROM teams");
        $teamsCount = pg_fetch_result($teamsResult, 0, 0);

        

        while ($row = pg_fetch_assoc($teamsResult) ){
            $logo_src =0;
            include 'logos_loader.php';
            echo   "
                      
                    <div class='team-container'>
                        <div class='team-info'>
                            <h2>".$row['name']."</h2>
                            <p>Nº de jogos: ".$row['matches_played']." </p>
                        </div>
                        <a id='open' href='#'>+</a>
                        <img src=".$logo_src." alt='team-logo'>
                    </div>
                    <div class='team-players' id='players'>
                        <ul>
                            <li>1</li>
                            <li>2</li>
                            <li>3</li>
                            <li>4</li>
                            <li>5</li>
                        </ul>
                    </div>";
        }
        ?>

    </div>
</main>
<footer>

</footer>
<script src="js/myscript.js"></script>
</body>
</html>
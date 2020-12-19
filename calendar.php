<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/calendar.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/myscript.js"></script>
    <title>Calendário</title>
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
        <h1>CALENDÁRIO</h1>
        <?php

        $str = "dbname=11champions user=postgres password=postgres host=localhost port=5432";
        $conn = pg_connect($str);
        error_reporting(0);



        $matchNov = pg_query($conn, "SELECT * FROM matches where '2020-11-01' <= day and day < '2020-12-01'") or die;
        $matchDez = pg_query($conn, "SELECT * FROM matches where '2020-12-01' <= day and day < '2021-01-01'") or die;


        $homeTeam = pg_query($conn, "SELECT teams.name from teams, matches WHERE teams.id = matches.teams_id") or die;
        $awayTeam = pg_query($conn, "SELECT teams.name from teams, matches WHERE teams.id = matches.teams_id1") or die;


        echo "<div class='round-container' id='nov'>
                <div class='month'>
                    <a href='#'>-</a>
                    <h2>NOVEMBRO</h2>
                    <a href='#'>+</a>
                </div>
                    <div class='calendar-container'>";
                while ($match = pg_fetch_assoc($matchNov) ) {
                    $home = pg_fetch_array($homeTeam);
                    $away = pg_fetch_array($awayTeam);
                    echo "
                        <div class='calendar-match'>
                            <div class='match-day'>
                                <p>".$match['round']."ª jornada</p>
                                <p>".date("d/m", strtotime($match['day']))."</p>
                            </div>
                            <div class='home-team team'>
                                <p>".$home['name']."</p>
                            </div>
                            <h3>".$match['result']."</h3>
                            <div class='away-team team'>
                                <p>".$away['name']."</p>
                            </div>
                        </div>
                    ";
            }
            echo "</div>
                 </div>";


        echo "<div class='round-container' id='dec' style='display: none'>
                <h2>DEZEMBRO</h2>
                    <div class='calendar-container'>";
        while ($match = pg_fetch_assoc($matchDez) ) {
            $home = pg_fetch_array($homeTeam);
            $away = pg_fetch_array($awayTeam);
            echo "
                        <div class='calendar-match'>
                            <div class='match-day'>
                                <p>".$match['round']."ª jornada</p>
                                <p>".date("d/m", strtotime($match['day']))."</p>
                            </div>
                            <div class='home-team team'>
                                <p>".$home['name']."</p>
                            </div>
                            <h3>".$match['result']."</h3>
                            <div class='away-team team'>
                                <p>".$away['name']."</p>
                            </div>
                        </div>
                    ";
        }
        echo "</div>
                 </div>";


        ?>

    </div>


</main>

</body>
</html>
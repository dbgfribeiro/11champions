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



        $matchNov = pg_query($conn, "SELECT * FROM matches where '2020-11-01' <= day AND day < '2020-12-01' ORDER BY day ASC") or die;
        $matchDec = pg_query($conn, "SELECT * FROM matches where '2020-12-01' <= day AND day < '2021-01-01' ORDER BY day ASC") or die;
        $matchJan = pg_query($conn, "SELECT * FROM matches where '2021-01-01' <= day AND day < '2021-02-01' ORDER BY day ASC") or die;
        $matchFeb = pg_query($conn, "SELECT * FROM matches where '2021-02-01' <= day AND day < '2021-03-01' ORDER BY day ASC") or die;

        //create one container for each month



        /*-----------------------NOVEMBER------------------------*/

        echo "<div class='round-container' id='nov'>
                <div class='month'>
                    <h2>NOVEMBRO<span>1/4</span></h2>
                    <div class='arrows'>
                        <p href='#' id='arrow-back'><i class='arrow back'></i></p>
                        <p href='#' id='arrow-front'><i class='arrow front'></i></p>
                    </div>
                </div>
                    <div class='calendar-container'>";

                while ($match = pg_fetch_assoc($matchNov) ) {
                    $homeTeam = pg_query($conn, "SELECT teams.name from teams, matches WHERE $match[teams_id] = teams.id") or die;
                    $awayTeam = pg_query($conn, "SELECT teams.name from teams, matches WHERE $match[teams_id1] = teams.id") or die;
                    $home = pg_fetch_array($homeTeam);
                    $away = pg_fetch_array($awayTeam);
                    echo "
                        <div class='calendar-match' content=".$match['result'].">
                            <div class='match-day'>
                                <p class='round'>".$match['round']."ª jornada</p>
                                <p>".date("d/m", strtotime($match['day']))."</p>
                            </div>
                            <div class='home-team team'>
                                <p>".$home['name']."</p>
                            </div>
                            <div class='result'>
                                <h3 content=".$match['goal_t1'].">".$match['goal_t1']."</h3>
                                <h3 class='sep'>:</h3>
                                <h3 content=".$match['goal_t2'].">".$match['goal_t2']."</h3>
                            </div>
                            <div class='away-team team'>
                                <p>".$away['name']."</p>
                            </div>
                        </div>
                    ";
            }
            echo "</div>
                 </div>";



        /*-----------------------DECEMBER------------------------*/

        echo "<div class='round-container' id='dec'>
                <div class='month'>
                    <h2>DEZEMBRO<span>2/4</span></h2>
                    <div class='arrows'>
                        <p id='arrow-back'><i class='arrow back'></i></p>
                        <p id='arrow-front'><i class='arrow front'></i></p>
                    </div>
                </div>
                    <div class='calendar-container'>";
        while ($match = pg_fetch_assoc($matchDec) ) {
            $homeTeam = pg_query($conn, "SELECT teams.name from teams, matches WHERE $match[teams_id] = teams.id") or die;
            $awayTeam = pg_query($conn, "SELECT teams.name from teams, matches WHERE $match[teams_id1] = teams.id") or die;
            $home = pg_fetch_array($homeTeam);
            $away = pg_fetch_array($awayTeam);
            echo "
                        <div class='calendar-match' content=".$match['result'].">
                            <div class='match-day'>
                                <p class='round'>".$match['round']."ª jornada</p>
                                <p>".date("d/m", strtotime($match['day']))."</p>
                            </div>
                            <div class='home-team team'>
                                <p>".$home['name']."</p>
                            </div>
                            <div class='result'>
                                <h3 content=".$match['goal_t1'].">".$match['goal_t1']."</h3>
                                <h3 class='sep'>:</h3>
                                <h3 content=".$match['goal_t2'].">".$match['goal_t2']."</h3>
                            </div>
                            <div class='away-team team'>
                                <p>".$away['name']."</p>
                            </div>
                        </div>
                    ";
        }
        echo "</div>
             </div>";


        
        /*-----------------------JANUARY------------------------*/

        echo "<div class='round-container' id='jan'>
                <div class='month'>
                    <h2>JANEIRO<span>3/4</span></h2>
                    <div class='arrows'>
                        <p id='arrow-back'><i class='arrow back'></i></p>
                        <p id='arrow-front'><i class='arrow front'></i></p>
                    </div>
                </div>
                <div class='calendar-container'>";
        while ($match = pg_fetch_assoc($matchJan) ) {
            $homeTeam = pg_query($conn, "SELECT teams.name from teams, matches WHERE $match[teams_id] = teams.id") or die;
            $awayTeam = pg_query($conn, "SELECT teams.name from teams, matches WHERE $match[teams_id1] = teams.id") or die;
            $home = pg_fetch_array($homeTeam);
            $away = pg_fetch_array($awayTeam);
            echo "
                        <div class='calendar-match' content=".$match['result'].">
                            <div class='match-day'>
                                <p class='round'>".$match['round']."ª jornada</p>
                                <p>".date("d/m", strtotime($match['day']))."</p>
                            </div>
                            <div class='home-team team'>
                                <p>".$home['name']."</p>
                            </div>
                            <div class='result'>
                                <h3 content=".$match['goal_t1'].">".$match['goal_t1']."</h3>
                                <h3 class='sep'>:</h3>
                                <h3 content=".$match['goal_t2'].">".$match['goal_t2']."</h3>
                            </div>
                            <div class='away-team team'>
                                <p>".$away['name']."</p>
                            </div>
                        </div>
                    ";
        }
        echo "</div>
             </div>";




        /*-----------------------FEBRUARY------------------------*/

        echo "<div class='round-container' id='fev'>
                <div class='month'>
                    <h2>FEVEREIRO<span>4/4</span></h2>
                    <div class='arrows'>
                        <p id='arrow-back'><i class='arrow back'></i></p>
                        <p id='arrow-front'><i class='arrow front'></i></p>
                    </div>
                </div>
                <div class='calendar-container'>";
        while ($match = pg_fetch_assoc($matchFeb) ) {
            $homeTeam = pg_query($conn, "SELECT teams.name from teams, matches WHERE $match[teams_id] = teams.id") or die;
            $awayTeam = pg_query($conn, "SELECT teams.name from teams, matches WHERE $match[teams_id1] = teams.id") or die;
            $home = pg_fetch_array($homeTeam);
            $away = pg_fetch_array($awayTeam);
            
            echo "
                        <div class='calendar-match' content=".$match['result'].">
                            <div class='match-day'>
                                <p class='round'>".$match['round']."ª jornada</p>
                                <p>".date("d/m", strtotime($match['day']))."</p>
                            </div>
                            <div class='home-team team'>
                                <p>".$home['name']."</p>
                            </div>
                            <div class='result'>
                                <h3 content=".$match['goal_t1'].">".$match['goal_t1']."</h3>
                                <h3 class='sep'>:</h3>
                                <h3 content=".$match['goal_t2'].">".$match['goal_t2']."</h3>
                            </div>
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
<script src="js/mainscript.js"></script>
<script src="js/calendar.js"></script>
</body>
</html>
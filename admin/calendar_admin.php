<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="../image/png" sizes="32x32" href="../img/favicon-32x32.png">
    <link rel="icon" type="../image/png" sizes="16x16" href="../img/favicon-16x16.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/calendar.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>admin_Calendário</title>
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
        <h1>CALENDÁRIO</h1>
        <?php

        $str = "dbname=11champions user=postgres password=postgres host=localhost port=5432";
        $conn = pg_connect($str);
        error_reporting(0);

        /*-----------------------CALENDAR-DISPLAY------------------------*/

        $matchNov = pg_query($conn, "SELECT * FROM matches where '2020-11-01' <= day AND day < '2020-12-01' ORDER BY day ASC") or die;
        $matchDec = pg_query($conn, "SELECT * FROM matches where '2020-12-01' <= day AND day < '2021-01-01' ORDER BY day ASC") or die;
        $matchJan = pg_query($conn, "SELECT * FROM matches where '2021-01-01' <= day AND day < '2021-02-01' ORDER BY day ASC") or die;
        $matchFeb = pg_query($conn, "SELECT * FROM matches where '2021-02-01' <= day AND day < '2021-03-01' ORDER BY day ASC") or die;

        //create one container for each month



        /*-----------------------NOVEMBER------------------------*/

        echo "<div class='round-container' id='nov'>
                <div class='month'>
                    <h2>NOVEMBRO<span>1/4</span></h2>
                    <a href='#' id='add' onclick='add()'>+</a>
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
                            <a id='delete' href='admin_updates.php?rm=$match[id]'>x</a>
                        </div>
                    ";
            }
            echo "</div>
                 </div>";



        /*-----------------------DECEMBER------------------------*/

        echo "<div class='round-container' id='dec'>
                <div class='month'>
                    <h2>DEZEMBRO<span>2/4</span></h2>
                    <a href='#' id='add' onclick='add()'>+</a>
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
                            <a id='delete' href='admin_updates.php?rm=$match[id]'>x</a>
                        </div>
                    ";
        }
        echo "</div>
             </div>";



        /*-----------------------JANUARY------------------------*/

        echo "<div class='round-container' id='jan'>
                <div class='month'>
                    <h2>JANEIRO<span>3/4</span></h2>
                    <a href='#' id='add' onclick='add()'>+</a>
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
                            <a id='delete' href='admin_updates.php?rm=$match[id]'>x</a>
                        </div>
                    ";
        }
        echo "</div>
             </div>";



        /*-----------------------FEBRUARY------------------------*/

        echo "<div class='round-container' id='fev'>
                <div class='month'>
                    <h2>FEVEREIRO<span>4/4</span></h2>
                    <a href='#' id='add' onclick='add()'>+</a>
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
                            <a id='delete' href='admin_updates.php?rm=$match[id]'>x</a>
                        </div>
                    ";
        }
        echo "</div>
             </div>";




        $roundsResult = pg_query($conn, "SELECT round, MAX(round) AS maxround, COUNT(*) AS nrounds FROM matches GROUP BY round ORDER BY round ASC");

        $homeTeam = pg_query($conn, "SELECT teams.name as homename , teams.id as homeid from teams ORDER BY teams.name ASC") or die;
        $awayTeam = pg_query($conn, "SELECT teams.name as awayname , teams.id as awayid from teams ORDER BY teams.name ASC") or die;


        //form to schedule matches
        echo "
            <div class='add-match' id='addMatch' style='display: none'>
            <div class='add-match-back' onclick='added()'></div>
            <div class='add-match-form'>
                <p>Adicionar Jogo</p>

                <form method='POST'>
                    <select class='ro' name='round' onChange='dateSelect(this);'>
                        <option disabled value='' selected>Nº Jornada</option>";
                        //create an option for each round
                        for($i=1; $i<=14; $i++) {
                            echo "<option value=".$i.">".$i."</option>";
                        }
                    echo"
                    </select>

                    <input class='dt' disabled id='date' type='date' name='date'></input>

                    <div class='teams'>
                
                    <select class='ht' name='hometeam'>
                        <option disabled value='' selected>Visitado</option>";
                    while ($homeRow = pg_fetch_assoc($homeTeam) ){
                        //select home team
                        echo "<option value='".$homeRow['homeid']."'>".$homeRow['homename']."</option>";
                    }
                    echo"
                    </select>
                    
                    <p>vs</p>

                    <select class='at' name='awayteam'>
                        <option disabled value='' selected>Visitante</option>";  
                    while ($awayRow = pg_fetch_assoc($awayTeam) ){
                        //select away team
                        echo "<option value='".$awayRow['awayid']."'>".$awayRow['awayname']."</option>";
                    }
                    echo"
                    </select>
                    </div>

                    <input class='submit' type='submit' name='submit' value='Submeter'>
            
                </form>

                </div>
            </div>
        ";

        $dt = $_POST['date'];
        $ro = $_POST['round'];
        $ht = $_POST['hometeam'];
        $at = $_POST['awayteam'];

            if ($ht != $at){
                    $query="INSERT INTO matches (day, goal_t1, goal_t2, round, teams_id, teams_id1)
                            VALUES ('$dt', NULL , NULL , '$ro', '$ht', '$at' );";
        
                    $data=pg_query($conn,$query);
                    $count = pg_num_rows($data);
                    
                    if ($data){
                        echo"
                        <div class='add-match' style='display: block'>
                            <div class='add-match-back'></div>
                            <div class='new-match'>
                                <p>O Jogo:</p>
                                <div class='new-info'>
                                    <p>No dia <span style='color:#FBE204'>".$dt."</span> a contar para a <span style='color:#FBE204'>".$ro."ª Jornada</span></p>
                                </div>
                                <p>Foi adicionado!</p>
                                <a href='calendar_admin.php'>Voltar</a>
                        </div>
                     ";
                    }
                }

        ?>

        


    </div>


</main>
<script src="../js/mainscript.js"></script>
<script src="../js/calendar.js"></script>
</body>
</html>
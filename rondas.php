
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php

$str = "dbname=11champions user=postgres password=postgres host=localhost port=5432";
$conn = pg_connect($str);
error_reporting(0);

$roundsResult = pg_query($conn, "SELECT round, COUNT(*) AS nrounds FROM matches GROUP BY round ORDER BY round asc");



$homeTeam = pg_query($conn, "SELECT teams.name as homename , teams.id as homeid from teams") or die;
$awayTeam = pg_query($conn, "SELECT teams.name as awayname , teams.id as awayid from teams") or die;


echo "
<form method='get'>

    <select name='round' onChange='dateSelect(this);'>
        <option disabled value='' selected>Nº Jornada</option>";
        while ($numRounds = pg_fetch_assoc($roundsResult) ) {
            if($numRounds['nrounds'] == 4){
                echo "<option disabled value='".$numRounds['round']."'>".$numRounds['round']."</option>";
            }
            else {
                echo "<option value='".$numRounds['round']."'>".$numRounds['round']."</option>";
            }
        }
echo"
    </select>
    <input disabled id='date' type='date' name='date'></input>

    <select name='hometeam'>
    <option disabled value='' selected>Visitado</option>";
    while ($homeRow = pg_fetch_assoc($homeTeam) ){
        echo "<option value='".$homeRow['homeid']."'>".$homeRow['homename']."</option>";
    }
    echo"
    </select>
    
    <select name='awayteam'>
    <option disabled value='' selected>Visitante</option>";  
    while ($awayRow = pg_fetch_assoc($awayTeam) ){
        echo "<option value='".$awayRow['awayid']."'>".$awayRow['awayname']."</option>";
    }
    echo"
    </select>
    <input type='submit' name='submit' value='Submeter'>
</form>
";


$dt = $_GET['date'];
$ro = $_GET['round'];
$ht = $_GET['hometeam'];
$at = $_GET['awayteam'];

echo "<br>";
    echo "Nº da Jornada: ".$ro."";
    echo "<br>";
    echo "Data do Jogo: ".$dt."";
    echo "<br>";
    echo "Visitado: ".$ht."";
    echo "<br>";
    echo "Visitante: ".$at."
";

if ($ht != $at){
    $query="INSERT INTO matches (day, goal_t1, goal_t2, round, teams_id, teams_id1)
            VALUES ('$dt', NULL , NULL , '$ro', '$ht', '$at' );";

    $data=pg_query($conn,$query);
}


?>

<script src="../js/calendar.js"></script>
</body>
</html>
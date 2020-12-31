<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/leaderboards.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/myscript.js"></script>
    <title>Classificações</title>
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
        <h1>CLASSIFICAÇÕES</h1>

        <?php
        $str = "dbname=11champions user=postgres password=postgres host=localhost port=5432";
        $conn = pg_connect($str);

        if(isset($_GET['order'])){
                $order = $_GET['order'];
        }
        else{
                $order = 'points';
        }

        if(isset($_GET['sort'])){
                $sort = $_GET['sort'];
        }
        else{
                $sort = 'DESC';
        }
        $rowCount = 1;
        $leaderboards = pg_query($conn, " SELECT  *  FROM leaderboards, teams
                                        WHERE leaderboards.teams_id = teams.id
                                        ORDER BY $order $sort");

        if(pg_num_rows($leaderboards) > 0){

                $sort == 'DESC' ? $sort = 'ASC' : $sort = 'DESC';

                echo "
                <table>
                    <tr>
                        <th>#</th>
                        <th><a href='?order=name&&sort=$sort'>Equipa</a></th>
                        <th><a href='?order=points&&sort=$sort'>P</a></th>
                        <th><a href='?order=matches_played&&sort=$sort'>NºJ</a></th>
                        <th><a href='?order=wins&&sort=$sort'>V</a></th>
                        <th><a href='?order=draws&&sort=$sort'>E</a></th>
                        <th><a href='?order=loses&&sort=$sort'>D</a></th>
                        <th><a href='?order=g_scored&&sort=$sort'>GM</a></th>
                        <th><a href='?order=g_conceed&&sort=$sort'>GS</a></th>
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


        ?>
    </div>
</main>
<script>    
    if(typeof window.history.pushState == 'function') {
        window.history.pushState({}, "Hide", "teste.php");
    }
</script>
</body>
</html>
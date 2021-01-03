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
                        <th><a href='?category=name&&order=$order' target='_top'>Equipa</a></th>
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


        ?>
    </div>
</main>
<script src="js/myscript.js"></script>
</body>
</html>
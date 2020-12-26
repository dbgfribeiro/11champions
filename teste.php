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
                $order = 'name';
        }

        if(isset($_GET['sort'])){
                $sort = $_GET['sort'];
        }
        else{
                $sort = 'ASC';
        }

        $result = pg_query($conn, " SELECT  *  FROM teams ORDER BY $order $sort;");
        $rowCount = pg_fetch_result($result, 0, 0);

        if(pg_num_rows($result) > 0){

                $sort == 'DESC' ? $sort = 'ASC' : $sort = 'DESC';

                echo "
                <table>
                    <tr>
                        <th># <a href='?order=id&&sort=$sort'><i class='arrow down'></i></a></th>
                        <th>Equipa <a href='?order=name&&sort=$sort'><i class='arrow down'></i></a></th>
                    </tr>";
        while ($rows = pg_fetch_assoc($result) ){

                echo   "<tr>
                           <td>".$rows['id']."</td>
                           <td>".$rows['name']."</td>
                        </tr>";
                }
                echo  "</table>";
        }
        ?>
    </div>
</main>

</body>
</html>
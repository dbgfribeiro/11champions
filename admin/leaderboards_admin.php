<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="../image/png" sizes="32x32" href="../img/favicon-32x32.png">
    <link rel="icon" type="../image/png" sizes="16x16" href="../img/favicon-16x16.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/leaderboards.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/myscript.js"></script>
    <title>admin_Classificações</title>
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
        <h1>CLASSIFICAÇÕES</h1>

        <?php

        /*leaderboards table*/

        echo "
                <table>
                    <tr>
                        <th>#</th>
                        <th>Equipa</th>
                        <th>P</th>
                        <th>NºJ</th>
                        <th>V</th>
                        <th>E</th>
                        <th>D</th>
                        <th>GM</th>
                        <th>GS</th>
                    </tr>";

        $str = "dbname=11champions user=postgres password=postgres host=localhost port=5432";
        $conn = pg_connect($str);
        $result = pg_query($conn, " SELECT  *  FROM teams ORDER BY name ASC;");
        $rowCount = pg_fetch_result($result, 0, 0);

        while ($row = pg_fetch_assoc($result) ){
            echo   "<tr>
                       <td>".$rowCount++."</td>
                       <td>".$row['name']."</td>
                       <td>0</td>
                       <td>".$row['matches_played']."</td>
                       <td></td>
                       <td></td>
                       <td></td>
                       <td></td>
                       <td></td>
                    </tr>";
        }
        echo  "</table>";
        ?>
    </div>
</main>

</body>
</html>
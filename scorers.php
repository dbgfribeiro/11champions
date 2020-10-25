<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>11 Eleven</title>
</head>
<body>
<header>
    <nav>
        <div class="nav-menu">
            <a href="index.html" id="logo">1<span>1</a>
            <ul>
                <a href="/"><li>CLASSIFICAÇÃO</li></a>
                <a href="/"><li>ÚLTIMOS RESULTADOS</li></a>
                <a href="/"><li>CALENDÁRIO</li></a>
                <a href="/"><li>MARCADORES</li></a>
            </ul>
        </div>

        <div class="container">

                <?php
                echo "
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Posição</th>
                        <th>País</th>
                        <th>Nº de golos</th>
                        <th>Equipa</th>
                    </tr>";

                $str = "dbname=11test user=postgres password=postgres host=localhost port=5432";
                $conn = pg_connect($str);
                $result = pg_query($conn, " SELECT  *  FROM player;");
                while ($row = pg_fetch_assoc($result) ){
                echo   "<tr>
                            <td>".$row['id_player']."</td>
                            <td>".$row['name']."</td>
                            <td>".$row['position']."</td>
                            <td>".$row['country']."</td>
                            <td>".$row['goals']."</td>
                            <td>".$row['team']."</td>
                        </tr>";
                }
                echo  "</table>";
                ?>
        </div>

    </nav>
</header>
<main>

</main>
<footer>

</footer>
</body>
</html>
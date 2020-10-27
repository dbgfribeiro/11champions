<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/leaderboards.css">
    <title>11Champions</title>
</head>
<body>

<header>
    <nav>
        <div class="nav-menu">
            <a href="index.html" id="logo">1<span>1</a>
            <div class="hamburguer" onclick="myFunction(this)">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
            </div>

            <div class="search">
                <button onclick="searchOpen()"><img src="img/search.png" alt="search"></button>
                <input id="searchBar" type="text" placeholder="Search..">
            </div>

            <div class="menu-desktop">
                <ul>
                    <a href="leaderboards.php"><li>CLASSIFICAÇÃO</li></a>
                    <a href="/"><li>ÚLTIMOS RESULTADOS</li></a>
                    <a href="/"><li>CALENDÁRIO</li></a>
                    <a href="scorers.php"><li>MARCADORES</li></a>
                </ul>
            </div>
            <div class="menu-mobile" id="mobile" >
                <ul>
                    <a href="leaderboards.php"><li>CLASSIFICAÇÃO</li></a>
                    <a href="/"><li>ÚLTIMOS RESULTADOS</li></a>
                    <a href="/"><li>CALENDÁRIO</li></a>
                    <a href="scorers.php"><li>MARCADORES</li></a>
                </ul>
            </div>
            <script>
                function myFunction(x) {
                    x.classList.toggle("change");
                    var menu = document.getElementById("mobile");
                    menu.style.transition = menu.style.transition == "height 0.3s ease-out" ? "height 0.15s ease-in" : "height 0.3s ease-out";
                    menu.style.height = menu.style.height == "100vh" ? "0" : "100vh";
                }
                function searchOpen(){
                    document.getElementById("searchBar").style.width = "25%";
                    document.getElementById("searchBar").style.opacity = "100";
                }

            </script>

        </div>

    </nav>

</header>

<main>
    <div class="container">
        <h1>CLASSIFICAÇÕES</h1>

        <?php
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

        $str = "dbname=11test user=postgres password=postgres host=localhost port=5432";
        $conn = pg_connect($str);
        $result = pg_query($conn, " SELECT  *  FROM team ORDER BY points DESC;");
        $rowCount = pg_fetch_result($result, 0, 0);

        while ($row = pg_fetch_assoc($result) ){
            echo   "<tr>
                       <td>".$rowCount++."</td>
                       <td>".$row['team_name']."</td>
                       <td>".$row['points']."</td>
                       <td>".$row['n_games']."</td>
                       <td>".$row['win']."</td>
                       <td>".$row['lose']."</td>
                       <td>".$row['draw']."</td>
                       <td>".$row['g_scored']."</td>
                       <td>".$row['g_conceded']."</td>
                    </tr>";
        }
        echo  "</table>";
        ?>
    </div>
</main>
<footer>

</footer>
</body>
</html>
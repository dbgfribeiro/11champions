<nav>
    <div class="nav-menu">
        <a href="index.html" id="logo"><img src="img/icon.png" alt="logo"></a>
        <div class="hamburguer" onclick="myFunction(this)">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
        </div>

        <div class="search">
            <button id="searchOpen"><img src="img/search.png" alt="search"></button>
            <form id="searchBar" method="get" action="leaderboards.php">
                    <span>
                        <input name="search" type="text" placeholder="Search..">
                        <input name="submit" type="submit" value=">" />
                    </span>
            </form>
        </div>

        <div class="menu-desktop">
            <ul>
                <a href="teams.php"><li>EQUIPAS</li></a>
                <a href="leaderboards.php"><li>CLASSIFICAÇÃO</li></a>
                <a href="results.php"><li>ÚLTIMOS RESULTADOS</li></a>
                <a href="calendar.php"><li>CALENDÁRIO</li></a>
                <a href="scorers.php"><li>MARCADORES</li></a>
            </ul>
        </div>
        <div class="menu-mobile" id="mobile" >
            <ul>
                <a href="teams.php"><li>EQUIPAS</li></a>
                <a href="leaderboards.php"><li>CLASSIFICAÇÃO</li></a>
                <a href="results.php"><li>ÚLTIMOS RESULTADOS</li></a>
                <a href="calendar.php"><li>CALENDÁRIO</li></a>
                <a href="scorers.php"><li>MARCADORES</li></a>
            </ul>
        </div>

    </div>

</nav>

<?php

?>

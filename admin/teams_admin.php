<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="../image/png" sizes="32x32" href="../img/favicon-32x32.png">
    <link rel="icon" type="../image/png" sizes="16x16" href="../img/favicon-16x16.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/teams.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>admin_Equipas</title>
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

    <?php
    $str = "dbname=11champions user=postgres password=postgres host=localhost port=5432";
    $conn = pg_connect($str);
    error_reporting(0);



    /*---------------------------------ADD PLAYER FORM-----------------------------*/

    /*----------get table teams info-----------*/
    $teamsResult = pg_query($conn, "SELECT teams.name AS team_name , teams.id AS team_id FROM teams ORDER BY team_name ASC");


    echo "
            <div class='add-player' id='addPlayer'>
                <div class='add-player-back' onclick='added()'></div>
                <div class='add-player-form'>
                    <p>Adicionar Jogador</p>

                    <form method='get'>
                    
                        <select class='tm' name='team' required>
                            <option disabled value='' selected>Equipa</option>";
                            /*----------option to choose team name-----------*/
                            while ($row = pg_fetch_assoc($teamsResult) ){
                                echo "<option value='".$row['team_id']."'>".$row['team_name']."</option>";
                            }
    echo "              </select>    
                   
                        <input class='pn' type='text' placeholder='Nome do jogador' name='player' required>
                        
                        <select class='pp' name='pos' required>
                            <option disabled value='' selected>Posição</option>";
                            /*----------option to choose player position-----------*/
                            $newPlayer = pg_query($conn, "SELECT DISTINCT position from player ");
                            while ($row2 = pg_fetch_assoc($newPlayer) ) {
                                echo "<option value='".$row2['position']."'>".$row2['position']."</option>";
                            }
    echo"               </select>   
               
                        <input class='pa' type='number' placeholder='Idade' name='age' required>

                        <input class='submit' type='submit' name='submit' value='Submeter'>
                        
                    </form>
                </div>
            </div>
        ";

    $tid=$_GET['team'];
    $pn=$_GET['player'];
    $pp=$_GET['pos'];
    $pa=$_GET['age'];

    /*----------insert into player form's received data-----------*/
    $query="INSERT INTO player (name, age, position, teams_id)
            VALUES ('$pn', '$pa', '$pp', '$tid');";

    $data=pg_query($conn,$query);

    if ($data){
        header("refresh:3;url=../admin/teams_admin.php");
        echo"
            <div class='add-player' style='display: block'>
                <div class='add-player-back' onclick='added()'></div>
                <div class='add-player-form'>
                  <p>O jogador <span style='color: #FBE204'>".$pn."</span> foi inserido!</p>
                </div>
            </div>
         ";
    }

    ?>


    <div class="container">
        <h1>EQUIPAS</h1>

        <?php


        /*----------get table teams info-----------*/
        if (isset($_POST['search'])){
            $search = $_POST['search'];
            $teamsResult = pg_query($conn, "SELECT * FROM teams WHERE name = '$search'");
        }
        
        else{
            $teamsResult = pg_query($conn, "SELECT * FROM teams ORDER BY name ASC");
        }
        
        
        while ($row = pg_fetch_assoc($teamsResult) ){

            $logo_src = 0;
            include '../logos_loader.php';
            echo   "

            <div class='team-container'>
                <div class='team-info'>
                    <div class='team-desc'>
                    <h2>".$row['name']."</h2>
                    <p>Nº de jogos: ".$row['matches_played']." </p>
                    </div>
                    <a id='open' href='#'>+</a>
                    <img src=../".$logo_src." alt='team-logo'>
                </div>
               
                <div class='team-players' id='players'>
                ";



            /*----------get position 'Avançado' from player-----------*/
            $avancadoResult = pg_query($conn, "SELECT player.name as player_name , position, age, id as player_id 
                                                    from player
                                                    where teams_id='$row[id]' and position='Avançado'
                                                    order by player_name asc ");
            echo "<ul>";
            echo "<h3>Avançados</h3>";
            while ($playerRow = pg_fetch_assoc($avancadoResult) ){
                echo "<li>".$playerRow['player_name']."<br>
                      <span>".$playerRow['age']." anos</span>
                      <a id='delete' href='admin_addmatch.php?rn=$playerRow[player_id]'>x</a>
                      </li>";
            }
            echo "</ul>";



            /*----------get position 'Médio' from player-----------*/
            $medioResult = pg_query($conn, "SELECT player.name as player_name , position, age, id as player_id
                                                    from player
                                                    where teams_id='$row[id]' and position='Médio'
                                                    order by player_name asc ");
            echo "<ul>";
            echo "<h3>Médios</h3>";
            while ($playerRow = pg_fetch_assoc($medioResult) ){
                echo "<li>".$playerRow['player_name']."<br>
                      <span>".$playerRow['age']." anos</span>
                      <a id='delete' href='admin_addmatch.php?rn=$playerRow[player_id]'>x</a>
                      </li>";
            }
            echo "</ul>";



            /*----------get position 'Defesa' from player-----------*/
            $defesaResult = pg_query($conn, "SELECT player.name as player_name , position, age, id as player_id 
                                                    from player
                                                    where teams_id='$row[id]' and position='Defesa'
                                                    order by player_name asc ");
            echo "<ul>";
            echo "<h3>Defesas</h3>";
            while ($playerRow = pg_fetch_assoc($defesaResult) ){
                echo "<li>".$playerRow['player_name']." <br>
                      <span>".$playerRow['age']." anos</span>
                      <a id='delete' href='admin_addmatch.php?rn=$playerRow[player_id]'>x</a>
                      </li>";
            }
            echo "</ul>";



            /*----------get position 'Guarda Redes' from player-----------*/
            $grResult = pg_query($conn, "SELECT player.name as player_name , position, age, id as player_id 
                                                    from player
                                                    where teams_id='$row[id]' and position='Guarda Redes'
                                                    order by player_name asc ");
            echo "<ul>";
            echo "<h3>Guarda Redes</h3>";
            while ($playerRow = pg_fetch_assoc($grResult) ){
                echo "<li>".$playerRow['player_name']." <br>
                      <span>".$playerRow['age']." anos</span>
                      <a id='delete' href='admin_addmatch.php?rn=$playerRow[player_id]'>x</a>
                      </li>";
            }
            echo "</ul>";


            echo "
                    <button id='editPlayer' onclick='add()'>Editar</button> <!-- button that opens add player form -->
                </div>
            </div>
          ";
        }

        ?>
    </div>

</main>

<script src="../js/myscript.js"></script>
</body>
</html>
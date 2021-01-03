<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="../image/png" sizes="32x32" href="../img/favicon-32x32.png">
    <link rel="icon" type="../image/png" sizes="16x16" href="../img/favicon-16x16.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/login.css">
    <title>11Champions</title>
</head>
<body>
<main>
    <div class="back">
        <img src="../img/logo11.png" alt="logo-11eleven">
    </div>

<?php
    $str = "dbname=11champions user=postgres password=postgres host=localhost port=5432";
    $conn = pg_connect($str);

    error_reporting(0);

    /*imports from match result*/
    $hg = $_POST['hgoal'];
    $ag= $_POST['agoal'];
    $mt= $_POST['sub'];

    /*imports from match scorers*/
    $pn = $_POST['pname'];
    $min = $_POST['minute'];
    $add = $_POST['add'];

    $delete=$_GET['rp'];
    $deleteMid=$_GET['rpm'];


    /*imports from calendar*/
    $deleteCal=$_GET['rm'];


    /*imports from teams*/
    $deletePl=$_GET['rn'];
    


    if(isset($mt)){
        $query = "UPDATE matches
                SET goal_t1 = '$hg', goal_t2 = '$ag'
                WHERE id = '$mt'";

        $data=pg_query($conn, $query);

        echo"
            <div class='main'>
                <div class='error'>
                    <p>Resultado Alterado!</p>
                </div>
            </div>
         ";
        header("refresh:2;url=../admin/results_admin.php");
    }

    else if(isset($add)){
        $query = "INSERT INTO goals (minute, player_id, matches_id)
                  VALUES ('$min', '$pn', '$add')";

        $data=pg_query($conn, $query);
        header('location: ../admin/results_admin.php');
    }

    else if(isset($delete)){
        $query = "DELETE FROM goals WHERE player_id = '$delete' AND goals.matches_id = '$deleteMid'";

        $data=pg_query($conn, $query);
        
        header('location: ../admin/results_admin.php');
    }

    else if(isset($deleteCal)){
        $query = "DELETE FROM matches WHERE id = '$deleteCal'";

        $data=pg_query($conn, $query);

        echo"
        <div class='main'>
            <div class='error'>
                <p>Jogo Removido!</p>
            </div>
        </div>
     ";
     header("refresh:2;url=../admin/calendar_admin.php");
    }

    else if(isset($deletePl)){
        $query = "DELETE FROM player WHERE id = '$deletePl'";

        $data=pg_query($conn, $query);

        echo"
            <div class='main'>
                <div class='error'>
                    <p>Jogador removido!</p>
                </div>
            </div>
         ";
        header("refresh:2;url=../admin/teams_admin.php");
    }




    else{
        echo"
            <div class='main'>
                <div class='error'>
                    <p>Erro ao atualizar</p>
                </div>
            </div>
         ";
        header("refresh:2;url=../admin/teams_admin.php");
    }



    ?>


</main>
</body>
</html>

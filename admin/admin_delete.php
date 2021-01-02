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

    $rollno=$_GET['rn'];

    $query = "DELETE FROM player WHERE id = '$rollno'";

    $data=pg_query($conn, $query);

    if ($data){
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
                    <p>Erro ao eliminar jogador</p>
                </div>
            </div>
         ";
         header("refresh:2;url=../admin/teams_admin.php");
    }

    ?>

</main>
</body>
</html>


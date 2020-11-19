<?php
session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">
    <title>11 Eleven</title>
</head>
<body>
<main>
    <div class="back">
        <img src="img/logo11.png" alt="logo-11eleven">
    </div>


    <?php
    error_reporting(0);
    $email = $_POST['email'];
    $password = $_POST['password'];

    $str = "dbname=11champions user=postgres password=postgres host=localhost port=5432";
    $conn = pg_connect($str);
    $result = pg_query($conn, "SELECT * FROM admin where email='$email' and password='$password'")
    or die("Erro ao conectar!".pg_error());

    $row = pg_fetch_array($result);

    if($row['email'] == $email && $row['password'] == $password){
        session_start();
        if (isset($_SESSION['count'])){
            $_SESSION['count'] ++;
        }
        else{
            $_SESSION['count'] = 1;
        }
        echo"
            <div class='main'>
                <div class='welcome'>
                    <p>Bem vindo <span style='color: #FBE204'>Administrador!</span></p>
                </div>
            </div>
           ";
        header("refresh:2;url=http://localhost:63342/11champions/teams_admin.php");
    }
    else{
        echo"
            <div class='main'>
                <div class='error'>
                    <p>Dados incorretos!</p>
                    <a href='http://localhost:63342/11champions/index.php'>Tentar novamente</a>
                </div>
            </div>
           ";
    }
    ?>

</main>
</body>
</html>

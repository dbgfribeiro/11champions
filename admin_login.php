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
    or die("Failed to query database".pg_error());

    $row = pg_fetch_array($result);

    if($row['email'] == $email && $row['password'] == $password){
        session_start();
        header("Location: http://localhost:63342/11champions/teams.php");
    }
    else{
        echo"
            <div class='main'>
                <div class='error'>
                    <p>Dados incorretos!</p>
                    <a href='http://localhost:63342/11champions/index.html'>Tentar novamente</a>
                </div>
            </div>
           ";
    }
    ?>

</main>
</body>
</html>

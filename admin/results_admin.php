<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/myscript.js"></script>
    <title>admin_Últimos Resultados</title>
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
        <h1>ÚLTIMOS RESULTADOS</h1>

        <p class="no-data">Ainda não há resultados</p>

        <?php

        $str = "dbname=11champions user=postgres password=postgres host=localhost port=5432";
        $conn = pg_connect($str);
        $result = pg_query($conn, " SELECT  *  FROM player;");

        ?>
    </div>
</main>

</body>
</html>
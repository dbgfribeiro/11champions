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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/myscript.js"></script>
    <title>11 Eleven</title>
</head>
<body>
    <?php
    session_unset();
    session_destroy();
    ?>
    <main>
        <div class="back">
            <img src="img/logo11.png" alt="logo-11eleven">
        </div>
        <section id="intro">
            <div class="start">
                <img src="img/logoG.png" alt="logo-11eleven">
            </div>
        </section>

        <section id="login">


            <div class="main">
                <div class='user_kind' id="userKind">
                    <p>Tipo de utilizador:</p>
                    <a href='teams.php'>Visitante</a>
                    <a href='#' id="admin">Administrador</a>
                </div>

                <div class="admin-login" id="adminLogin">
                    <p>Log in</p>
                    <form class="form1" method="POST" action="admin/admin_login.php">
                        <input class="un" type="email" placeholder="E-mail" name="email" required>
                        <input class="pass" type="password" placeholder="Password" name="password" required>
                        <input class="submit" type="submit" name="submit" value="Log in">
                    </form>
                </div>
            </div>
        </section>


    </main>
</body>
</html>
<?php
define('BANK', 'true');
define('MAIN_DIR', __DIR__.'/');




$route = str_replace(MAIN_DIR,'',$_SERVER['REQUEST_URI']);
_log($route);
if('login' == $route){
    header("Location: '/login/index.php'");
}
if('signup' == $route){
    header("Location: '/signup/index.php'");
}
if('add' == $route){
    header("Location: '/add/index.php'");
}
if('remove' == $route){
    header("Location: '/remove/index.php'");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaBank</title>
    <link rel="stylesheet" href="./css/main.css" type="text/css">
    <link rel="stylesheet" href="./css/login.css" type="text/css">
</head>

<body>
    <header id="header" class="container">
        <div class="row">
            <div class="logo col-12">LaBank</div>
            
        </div>
    </header>
    <main id="main_content" class="container">
        <div class="row">
            <div class="infoscreen col-12">
                <h1>Sveiki atvykę į LaBank</h1>
                <p>Norėdami prisijungti, įveskite prisijungimo duomenis</p>
                <form action="" method="post">
                    <input type="text" name="idNumber" id="idNumber" placeholder="Asmens kodas">
                    <input type="password" name="psw" id="psw" placeholder="Slaptažodis">
                    <button id="submit" type="submit">Prisijungti</button>
                </form>
            </div>
        </div>
        
    </main>
    <a href="./signup/">Atidaryti sąskaitą</a>
</body>

</html>
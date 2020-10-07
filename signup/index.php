<?php
require __DIR__.'/../data/addAccount.php';
_log($_GET);
_log($_POST);
$check = 0;
if(0 != count($_POST)){

    //check name
    
    //check surname
    
    //check id
    
    // check password
    if(md5($_POST['psw']) == md5($_POST['repeatPsw'])){
        $check++;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaBank</title>
    <link rel="stylesheet" href="../css/main.css" type="text/css">
    <link rel="stylesheet" href="../css/signup.css">
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
                <p>Norėdami užsiregistruoti užpildykite žemiau esančius laukus. Visi laukai yra privalomi</p>
                <form action="" method="post">
                    <input type="text" name="name" id="name" placeholder="Vardas">
                    <input type="text" name="surname" id="surname" placeholder="Pavardė">
                    <input type="text" name="idNumber" id="idNumber" placeholder="Asmens kodas">
                    <input type="password" name="psw" id="psw" placeholder="Slaptažodis">
                    <input type="password" name="repeatPsw" id="repeatPsw" placeholder="Pakartokite slaptažodį">
                    <button id="submit" type="submit">Atidaryti sąskaitą</button>
                </form>
            </div>
        </div>
    </main>
</body>

</html>
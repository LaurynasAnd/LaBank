<?php
session_start();
if(!($_SESSION['login'] ?? 0)){
    header('Location: ../');
    die;
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaBank</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/manipulate.css">
</head>

<body>
    <header id="header" class="container">
        <div class="row">
            <div class="logo col-11">LaBank</div>
            <a href="../login"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
        </div>
    </header>
    <main id="main_content" class="container">
        <div class="row">
            <div class="infoscreen col-12">
                <h1>Nuskaičiuoti lėšas</h1>
                <p>Įrašykite norimą pridėti sumą, žemiau pateiktame laukelyje</p>
                <div class="account-info">
                    <div class="name"><div class="label">
                        Vardas: 
                    </div>Jonas</div>
                    <div class="surname"><div class="label">
                        Pavardė: 
                    </div>Jonaitis</div>
                    <div class="iban"><div class="label">
                        Sąsk. numeris:
                    </div>LT100000215758450101</div>
                    <div class="balance"><div class="label">
                        Likutis: 
                    </div>1002451.25</div>
                    <div class="currency"><div class="label">
                        Valiuta: 
                    </div>Eur</div>
                </div>
                <form action="" method="post">
                    <input type="number" name="amount" id="amount" placeholder="Įveskite sumą">
                    <button id="submit" type="submit">Nuskaičiuoti</button>
                </form>
            </div>
        </div>
    </main>
</body>

</html>
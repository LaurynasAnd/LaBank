<?php 

// defined('BANK')  || die;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaBank</title>
    <link rel="stylesheet" href="../css/main.css" type="text/css">
</head>

<body>
    <header id="header" class="container">
        <div class="row">
            <div class="logo col-11">LaBank</div>
            <a href="../login/index.html"></a>
        </div>
    </header>
    <main id="main_content" class="container">
        <div class="row">
            <div class="infoscreen col-12">
                <h2 class="welcome">Sveiki, Jonai Jonaiti</h2>
                <div class="title">
                    <input type="checkbox" name="" id="check_all">
                    <div class="iban">Sąskaita</div>
                    <div class="amount">Galutinis likutis</div>
                </div>
                <div class="account">
                    <input type="checkbox" name="" class="check check1">
                    <div class="iban">LT100000215758453254 JONAS JONAITIS</div>
                    <div class="amount">1000251.25 &euro;</div>
                </div>
                <div class="account">
                    <input type="checkbox" name="" class="check check2">
                    <div class="iban">LT100000215758450101 JONAS JONAITIS</div>
                    <div class="amount">1000.5 &euro;</div>
                </div>
                <div class="mobile-account">
                    <div class="select">

                        <select name="iban-no" id="">
                            <option value="account1">LT100000215758453254</option>
                            <option value="account2">LT100000215758455500</option>
                        </select>
                    </div>
                    <div class="amount">
                        <label>Sąskaitos likutis</label>
                        <h2>1000251.25 &euro;</h2>
                    </div>
                </div>
                <button id="delete" type="submit">Ištrinti sąskaitą</button>
                <a href="../remove/index.php" class="link remove-money">Nuskaičiuoti lėšas</a>
                <a href="../add/index.php" class="link add-money">Pridėti lėšų</a>
            </div>
        </div>
    </main>
    <script src="../js/main.js" type="text/javascript"></script>
</body>

</html>
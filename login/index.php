<?php 
session_start();
if(!($_SESSION['login'] ?? 0)){
    header('Location: ../');
    die;
}
$answers = [
    'badInput' => ''
];
_log($_SESSION['user']);
$user = $_SESSION['user'];
_log($_POST??0);
if(isset($_POST['delete'])){
    if (0 !== $user['balance']){
        $answers['balance'] = 'Sąskaitą galima ištrinti, tik kai ji yra tuščia';
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
</head>

<body>
    <header id="header" class="container">
        <div class="row">
            <div class="logo col-11">LaBank</div>
            <a href="../index.php?logout=1" class="logout"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
        </div>
    </header>
    <main id="main_content" class="container">
        <div class="row">
            <form class="infoscreen col-12" method="post">
                <h2 class="welcome">Sveiki, <?=$user['name']?> <?=$user['surname']?></h2>
                <div class="title">
                    <input type="checkbox" name="" id="check_all">
                    <div class="iban">Sąskaita</div>
                    <div class="amount">Galutinis likutis</div>
                </div>
                <div class="account">
                    <input type="checkbox" name="marked-checkbox" value="<?=$user['iban']?>" class="check check1">
                    <div class="iban"><?=$user['iban']?> <?=strtoupper($user['name'])?> <?=strtoupper($user['surname'])?></div>
                    <div class="amount"><?=$user['balance']?> &euro;</div>
                </div>
                
                <div class="mobile-account">
                    <div class="select">

                        <select name="iban-no" id="">
                            <option value="account1"><?=$user['iban']?></option>
                        </select>
                    </div>
                    <div class="amount">
                        <label>Sąskaitos likutis</label>
                        <h2>1000251.25 &euro;</h2>
                    </div>
                </div>
                <button id="delete" type="submit" name="delete">Ištrinti sąskaitą</button>
                <a href="../remove/index.php" class="link remove-money">Nuskaičiuoti lėšas</a>
                <a href="../add/index.php" class="link add-money">Pridėti lėšų</a>
            </form>
        </div>
        <?php if(isset($answers['balance'])) : ?>
            <div id="message"><div class="message"><?=$answers['balance']?></div></div>
        <?php 
            unset($answers['balance']);endif; 
        ?>
    </main>
    <script src="../js/main.js" type="text/javascript"></script>
</body>

</html>
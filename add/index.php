<?php
session_start();
if(!($_SESSION['login'] ?? 0)){
    header('Location: ../');
    die;
}
$user = $_SESSION['user'];
$answers = [
    'badInput' => ''
];

//now checking if the right ammount is inserted
if (isset($_POST['amount'])){ // if Post['amount'] is not set, it means client just got here
    $amount = $_POST['amount'];
    //check if amount is correct.
    if(!preg_match('/[^0-9.,]/', $amount)){ //to check if only numbers and separators are input
        $amount = str_replace(',','.', $amount); //replace commas with dots.
        if(!(count($amount = preg_split('/\./', $amount)) > 2)){ //patikrinimas ar geras formatas, ty yra ar ne per daug skiriamuju zenklu
            //gerai   
            if(isset($amount[1]) && (strlen($amount[1])>2) ?? 0){ //check if decimal has only two digits
                $answers['badInput'] = 'Neteisingas sumos formatas';
            } else{
                $amount = $amount[0]+ ($amount[1] / (10**strlen($amount[1]))) ?? 0;
                if (0 == $amount){
                    $answers['badInput'] = 'Suma turi būti ne nulinė';
                } else {
                    require __DIR__.'/../data/changeBalance.php';
                    if($success = addMoney($user['idNumber'], $amount)){ //if money succesfully added, then redirect with success message
                        $_SESSION['message'] = 'Pinigai sėkmingai pridėti prie sąskaitos';
                        $_SESSION['user'] = $success;
                        header('Location: ../login/');
                        die;
                    } else {
                        $answers['badInput'] = 'Dėl techninių kliūčių pinigai negalėjo būti pridėti prie sąskaitos';
                    }
                }
            }

        } else {
            $answers['badInput'] = 'Neteisingas sumos formatas';
        }
    } else {
        $answers['badInput'] = 'Neteisingas sumos formatas';
    }


} //


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
                <h1>Pridėti lėšų</h1>
                <p>Įrašykite norimą pridėti sumą, žemiau pateiktame laukelyje</p>
                <div class="account-info">
                    <div class="name"><div class="label">
                        Vardas: 
                    </div><?=$user['name']?></div>
                    <div class="surname"><div class="label">
                        Pavardė: 
                    </div><?=$user['surname']?></div>
                    <div class="iban"><div class="label">
                        Sąsk. numeris:
                    </div><?=$user['iban']?></div>
                    <div class="balance"><div class="label">
                        Likutis: 
                    </div><?=$user['balance']?></div>
                    <div class="currency"><div class="label">
                        Valiuta: 
                    </div>Eur</div>
                </div>
                <form action="" method="post">
                    <input type="text" name="amount" id="amount" placeholder="Įveskite sumą">
                    <button id="submit" type="submit">Pridėti</button>
                </form>
            </div>
        </div>
        <?php if(isset($answers['badInput'])) : ?>
            <div id="message"><div class="message"><?=$answers['badInput']?></div></div>
        <?php 
            unset($answers['badInput']);endif; 
        ?>
    </main>
</body>

</html>
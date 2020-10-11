<?php

session_start();
$iban = json_decode(file_get_contents('../data/iban.json'), 1);
$check = 0; //this variable will count how many inputs are valid
$responses = [
    'wrongName' => '',
    'wrongSurname' => '',
    'badID' => '',
    'pswMissmatch' => '',
    'noSignup' => ''
];
if(0 != count($_POST)){ //patikrinama, ar post nera paliktas tuscias
    //check name
    if(!preg_match_all('/[^\p{L}\p{M}*]+/u', $_POST['name']) && 0 != strlen($_POST['name'])){ // checks if there are only letters and returns 0
        if (strlen($_POST['name'])>3){
            $check++;
        } else {
            $responses['wrongName'] = 'Vardas turi būti ilgesnis nei 3 simboliai';

        }
    } else {
        $responses['wrongName'] = 'Netinkamo formato vardas';
    }
    
    
    //check surname
    if(!preg_match_all('/[^\p{L}\p{M}*]+/u', $_POST['surname']) && 0 != strlen($_POST['surname'])){ // checks if there are only letters and returns 0
        if (strlen($_POST['surname'])>3){
            $check++;
        } else {
            $responses['wrongSurname'] = 'Pavardė turi būti ilgesnė nei 3 simboliai';

        }
    } else {
        $responses['wrongSurname'] = 'Netinkamo formato pavardė';
    }
    //check id Number
    if(!preg_match_all('/[^\d]/', $_POST['idNumber']) && 11 == strlen($_POST['idNumber'])){ //preg_match_all will return 0 if there are only numbers in ID code. id number is made of 11 digits
        //next two variables will check if gender digit and birth digits are valid
        $isGender = false;  
        $isDate = false;
        $gender = intval(substr($_POST['idNumber'],0,1)); //returns int, first digit from ID
        $birthDay = substr($_POST['idNumber'],1,6); //returns unformated date of birth
        if ($gender > 2 && $gender <= 6) { // first digit is for gender and can be 3, 4, 5 or 6
            $isGender = true;
        }
        //next the first two digits of the year will be determined. It can be done
        //by checking the gender digit. 3-4 are from 1900s 5-6 are from 2000s
        $year = (($gender == 3 || $gender == 4) ? '19' : '20') . substr($birthDay, 0, 2);
        $date = $year . '-' . substr($birthDay, 2, 2) . '-' . substr($birthDay, 4, 2); //the full year is constructed in format YYYY-MM-dd
        //the next function is used to validate the date. it return true if date is valid and false if date is not valid, for example 2020-10-01 is valid and 2020-13-01 is not
        function validateDate($date, $format = 'Y-m-d'){
            $d = DateTime::createFromFormat($format, $date);
            // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
            return $d && $d->format($format) === $date;
        }
        if(validateDate($date)){
            $isDate = true;
        }
        if($isGender && $isDate){
            $check++;
        } else {
            $responses['badID'] = 'Neteisingo formato asmens kodas';
        }

    } else {
        $responses['badID'] = 'Neteisingo formato asmens kodas';
    }
    // check password
    if (strlen($_POST['psw'])>=8){ //password must be at least 8 symbols long

        if(md5($_POST['psw']) == md5($_POST['repeatPsw']) && (0 != strlen($_POST['psw']) && 0 != strlen($_POST['repeatPsw']))){ //paswords are not empty and are the same
            $check++;
        } else {
            $responses['pswMissmatch'] = 'Nesutampa slaptažodžiai';
        }
    } else {
        $responses['pswMissmatch'] = 'Slaptažodis turi būti mažiausiai 8 simbolių';
    }


    if(4 == $check){ //jei praeina visus patikrinimus
        //prideti nauja vartotoja prie sistemos ikeliama funkcija.
        require __DIR__.'/../data/addAccount.php';
        if(addAccount([
            'surname' => ucfirst($_POST['surname']),
            'name' => ucfirst($_POST['name']),
            'idNumber' => $_POST['idNumber'],
            'psw' => md5($_POST['psw']),
            'balance' => 0
        ])){
            // jei priregino, peradresuoti i pagrindini puslapi nurodant jo paties ID sistemoje
            $_SESSION['message'] = 'Jūsų registracija sėkminga. Norėdami prisijungti prie elektroninės bankininkystės, įveskite prisijungimo duomenis';
            header('Location: ../'); //move one directory up
            die;
        } else {
            //jei nepavyko prisiregistruoti, i6mesti pranesima, kad tokiu ID jau registruotas zmogus
            $responses['noSignup'] = 'Vartotojas su tokiu asmens kodu jau registruotas.';
        }
        
    } else {
        //atmesti pildyma, ir parasyti, kas negerai parasyta buvo
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
            <div class="logo col-11">LaBank</div>
            <a href="../"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
        </div>
    </header>
    <main id="main_content" class="container">
        <div class="row">
            <div class="infoscreen col-12">
                <h1>Sveiki atvykę į LaBank</h1>
                <p>Norėdami užsiregistruoti užpildykite žemiau esančius laukus. Visi laukai yra privalomi.</p>
                <p style="color:red;"><?=$responses['noSignup']?></p>
                <form action="" method="post" accept-charset="utf-8">
                    <h3 id="iban">Nauja sąskaita: <?='LT'.$iban['nextIBAN']?></h3>
                    <div style="color:red; font-size:14px;"><?= $responses['wrongName']?></div>
                    <input type="text" name="name" id="name" placeholder="Vardas (min: 3 simboliai)">
                    <div style="color:red; font-size:14px;"><?= $responses['wrongSurname']?></div>
                    <input type="text" name="surname" id="surname" placeholder="Pavardė (min: 3 simboliai)">
                    <div style="color:red; font-size:14px;"><?= $responses['badID']?></div>
                    <input type="text" name="idNumber" id="idNumber" placeholder="Asmens kodas">
                    <div style="color:red; font-size:14px;"><?= $responses['pswMissmatch']?></div>
                    <input type="password" name="psw" id="psw" placeholder="Slaptažodis (min: 8 simboliai)">
                    <input type="password" name="repeatPsw" id="repeatPsw" placeholder="Pakartokite slaptažodį">
                    <button id="submit" type="submit">Atidaryti sąskaitą</button>
                </form>
            </div>
        </div>
    </main>
</body>

</html>
<?php
function addAccount($data){
    $db = json_decode(file_get_contents(__DIR__.'/data.json'), 1);
    if(isset($db[$data['idNumber']])){
        return false;
    } else {
        $iban = 'LT' . ($db['lastIBAN']+1);
        $db[$data['idNumber']] = [
            'surname' => $data['surname'],
            'name' => $data['name'],
            'idNumber' => $data['idNumber'],
            'psw' => $data['psw'],
            'iban' => 'LT200000202010010002',
            'balance' => 0
        ];
        $db['lastIBAN']++;
        file_put_contents(__DIR__.'/data.json', json_encode($db));
        return true;
    }
    
}
<?php
function addAccount($data){
    $db = json_decode(file_get_contents(__DIR__.'/users.json'), 1);
    $iban = json_decode(file_get_contents(__DIR__.'/iban.json'), 1);
    if(isset($db[$data['idNumber']])){
        return false;
    } else {
        $db[$data['idNumber']] = [
            'surname' => $data['surname'],
            'name' => $data['name'],
            'idNumber' => $data['idNumber'],
            'psw' => $data['psw'],
            'iban' => ('LT' . ($iban['nextIBAN'])),
            'balance' => 0
        ];
        uasort($db, fn($d1, $d2) => (($d1['surname'] ?? 0) <=> ($d2['surname'] ?? 0)));
        $iban['nextIBAN']++;
        file_put_contents(__DIR__.'/users.json', json_encode($db));
        file_put_contents(__DIR__.'/iban.json', json_encode($iban));
        return true;
    }
    
}
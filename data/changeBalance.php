<?php
function addMoney($userID, $amount){
    $db = json_decode(file_get_contents(__DIR__.'/users.json'), 1);
    $before = $db[$userID]['balance'];
    $new = round(($before + $amount) , 2);
    $db[$userID]['balance'] = $new;
    file_put_contents(__DIR__.'/users.json', json_encode($db));
    return $db[$userID];
}
function removeMoney($userID, $amount){
    $db = json_decode(file_get_contents(__DIR__.'/users.json'), 1);
    $before = $db[$userID]['balance'];
    $new = round(($before - $amount) , 2);
    $db[$userID]['balance'] = $new;
    file_put_contents(__DIR__.'/users.json', json_encode($db));
    return $db[$userID];
}
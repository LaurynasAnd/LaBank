<?php

function deleteAccount($userID){
    $db = json_decode(file_get_contents(__DIR__.'/users.json'), 1);
    unset($db[$userID]);
    file_put_contents(__DIR__.'/users.json', json_encode($db));
    return true;
}
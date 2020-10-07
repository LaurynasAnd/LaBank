<?php

$users = [
    100001 =>[
        'surname' => 'Jonaitis',
        'name' => 'Jonas',
        'idNumber' => '37001010101',
        'psw' => md5(123),
        'balance' => 1000
        ]
    
];
file_put_contents('data.json', json_encode($users));
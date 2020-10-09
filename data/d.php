<?php

$users = [
    '37001010101' =>[
        'surname' => 'Jonaitis',
        'name' => 'Jonas',
        'idNumber' => '37001010101',
        'psw' => md5(123),
        'balance' => 1000
        ]
    
];
file_put_contents('users.json', json_encode($users));
<?php

// Declarar as variaveis necessarias para gerar a minha conexão com o Banco de Dados...

$hostname = "fdb30.awardspace.net";
$dbname = "3809053_library";
$username = "3809053_library";
$password = "3762242_library";

try {
    $pdo = new PDO('mysql:host='.$hostname.';dbname='.$dbname, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo 'Conexão realizada com sucesso!';
} catch (PDOException $e) {
    echo 'Error: '.$e->getMessage();
}
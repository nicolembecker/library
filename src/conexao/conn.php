<?php

    // Declarar as variáveis necessárias para gerar a minha conexão com o banco de dados....
    $hostname = "fdb22.awardspace.net";
    $dbname = "2874836_library";
    $username = "2874836_library";
    $password = "Et3cL1br@ry";

    try {
        $pdo = new PDO('mysql:host='.$hostname.';dbname='.$dbname, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo 'Conexão realizada com sucesso!';
    } catch (PDOException $e) {
        echo 'Error: '.$e->getMessage();
    }
© 2021 GitHub, Inc.
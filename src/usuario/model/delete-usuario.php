<?php

//Instância do banco de dados
include("../../conexao/conn.php");

//Coleta do id que será excluido do nosso banco de dados que está sendo enviado pelo FORM
    $IDUSUARIO = $_REQUEST['IDUSUARIO'];

//Criar a nossa querie para interação com banco de dados 
    $sql = "DELETE FROM USUARIO WHERE IDUSUARIO = $IDUSUARIO";

//Executar a nossa querie
    $resultado = $pdo->query($sql);

//Testar o retorno do resultado da nossa querie
    if($resultado){
        $dados = array(
            'tipo' => 'success',
            'mensagem' => 'Registro excluido com sucesso',
        );
    } else{
        $dados = array(
            'tipo' => 'error',
            'mensagem' => 'Não foi possivel excluir o resgistro',
        );
    }

echo json_encode($dados);
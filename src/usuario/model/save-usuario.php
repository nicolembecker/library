<?php

    // Obter a nossa conexão com o banco de dados
    include('../../conexao/conn.php');

    // Obter os dados enviados do formulário via $_REQUEST
    $requestData = $_REQUEST;

    // Verificação de campo obrigatórios do formulário
    if(empty($requestData['NOME'])){
        // Caso a variável venha vazia eu gero um retorno de erro do mesmo
        $dados = array(
            "tipo" => 'error',
            "mensagem" => 'Existe(m) campo(s) obrigatório(s) não preenchido(s).'
        );
    } else {
        // Caso não exista campo em vazio, vamos gerar a requisição
        $IDUSUARIO = isset($requestData['IDUSUARIO']) ? $requestData['IDUSUARIO'] : '';
        $operacao = isset($requestData['operacao']) ? $requestData['operacao'] : '';

        // Verifica se é para cadastra um nvo registro
        if($operacao == 'insert'){
            // Prepara o comando INSERT para ser executado
            try{
                $stmt = $pdo->prepare('INSERT INTO USUARIO (NOME, EMAIL, SENHA, TIPO_USUARIO_IDTIPO_USUARIO, CURSO_IDCURSO) VALUES (:nome, :email, :senha, :tu, :cu)');
                $stmt->execute(array(
                    ':nome' => utf8_decode($requestData['NOME']),
                    ':email' => utf8_decode($requestData['EMAIL']),
                    ':senha' => md5($requestData['SENHA']),
                    ':tu'  => utf8_decode($requestData['TIPO_USUARIO_IDTIPO_USUARIO']),
                    ':cu'=> utf8_decode($requestData['CURSO_IDCURSO'])
                ));
                $dados = array(
                    "tipo" => 'success',
                    "mensagem" => 'Usuário cadastrado com sucesso.'
                );
            } catch(PDOException $e) {
                $dados = array(
                    "tipo" => 'error',
                    "mensagem" => 'Não foi possível efetuar o cadastro do usuário.'
                );
            }
        } else {
            // Se minha variável operação estiver vazia então devo gerar os scripts de update
            try{
                $stmt = $pdo->prepare('UPDATE USUARIO SET NOME = :nome, EMAIL = :email, SENHA = :senha, TIPO_USUARIO_IDTIPO_USUARIO = :tu, CURSO_IDCURSO = :cu WHERE IDUSUARIO = :id');
                $stmt->execute(array(
                    ':id' => $IDUSUARIO,
                    ':nome' => utf8_decode($requestData['NOME']),
                    ':email' => utf8_decode($requestData['EMAIL']),
                    ':senha' => md5($requestData['SENHA']),
                    ':tu'  => utf8_decode($requestData['TIPO_USUARIO_IDTIPO_USUARIO']),
                    ':cu'=> utf8_decode($requestData['CURSO_IDCURSO'])
                ));
                $dados = array(
                    "tipo" => 'success',
                    "mensagem" => 'Usuário atualizado com sucesso.'
                );
            } catch (PDOException $e) {
                $dados = array(
                    "tipo" => 'error',
                    "mensagem" => 'Não foi possível efetuar o alteração do usuário.'
                );
            }
        }
    }

    // Converter um array ded dados para a representação JSON
    echo json_encode($dados);
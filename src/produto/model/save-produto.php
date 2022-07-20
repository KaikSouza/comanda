<?php

    include('../../conexao/conexao.php');

    $requestData = $_REQUEST;

    if(empty($requestData['NOME']) && empty($requestData['LOGIN']) && empty($requestData['SENHA'])){
        $dados = array(
            "tipo" => 'error',
            "mensagem" => 'Existe(m) campo(s) obrigatório(s) não preenchido(s)!'
        );
    }else{
        $ID = isset($requestData['ID']) ? $requestData['ID'] : '';
        $operacao = isset($requestData['operacao']) ? $requestData['operacao'] : '';

        if($operacao == 'insert'){
            try{
                $stmt = $pdo->prepare("INSERT INTO EMPRESA (NOME, LOGIN, SENHA) VALUES (:a, :b, :c)");
                $stmt->execute(array(
                    ':a' => utf8_decode($requestData['NOME']),
                    ':b' => $requestData['LOGIN'],
                    ':c' => md5($requestData['SENHA'])
                ));
                $dados = array(
                    "tipo" => 'success',
                    "mensagem" => 'Empresa cadastrada com sucesso!'
                );
            }catch (PDOException $error){
                $dados = array(
                    "tipo" => 'error',
                    "mensagem" => 'Não foi possível realizar o cadastro da empresa! Erro: '.$error
                );
            }
        }else{
            try{
                $stmt = $pdo->prepare("UPDATE EMPRESA SET NOME = :a, LOGIN = :b, SENHA = :c WHERE  ID = :id");
                $stmt->execute(array(
                    ':id' => $ID,
                    ':a' => utf8_decode($requestData['NOME']),
                    ':b' => $requestData['LOGIN'],
                    ':c' => md5($requestData['SENHA'])
                ));
                $dados = array(
                    "tipo" => 'success',
                    "mensagem" => 'Empresa atualizada com sucesso!'
                );
            }catch (PDOException $error){
                $dados = array(
                    "tipo" => 'error',
                    "mensagem" => 'Não foi possível realizar a atualização da empresa! Erro: '.$error
                );
            }
        }
    }

    echo json_encode($dados);
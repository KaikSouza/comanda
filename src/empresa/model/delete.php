<?php

    include('../../conexao/conexao.php');

    $ID = $_REQUEST['ID'];

    $sql = "DELETE FROM EMPRESA WHERE ID = $ID";

    $resultado = $pdo->query($sql);

    if($resultado){
        $dados = array(
            'tipo' => 'success',
            'mensagem' => 'Empresa excluída com sucesso!'
        );
    }else{
        $dados = array(
            'tipo' => 'error',
            'mensagem' => 'Não foi possível excluir a empresa!'
        );
    }

    echo json_encode($dados);
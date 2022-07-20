<?php

    include('../../conexao/conexao.php');

    $ID = $_REQUEST['ID'];

    $sql = "DELETE FROM PRODUTO WHERE ID = $ID";

    $resultado = $pdo->query($sql);

    if($resultado){
        $dados = array(
            'tipo' => 'success',
            'mensagem' => 'Produto excluído com sucesso!'
        );
    }else{
        $dados = array(
            'tipo' => 'error',
            'mensagem' => 'Não foi possível excluir o produto!'
        );
    }

    echo json_encode($dados);
<?php

    include('../../conexao/conexao.php');

    $ID = $_REQUEST['ID'];

    $sql = "SELECT * FROM EMPRESA WHERE ID = $ID";

    $resultado = $pdo->query($sql);

    if($resultado){
        $result = array();
        while($row = $resultado->fetch(PDO::FETCH_ASSOC)){
            $result = array_map('utf8_encode', $row);
        }
        $dados = array(
            'tipo' => 'success',
            'mensagem' => '',
            'dados' => $result
        );
    }else{
        $dados = array(
            'tipo' => 'success',
            'mensagem' => 'Não foi possível encontrar a empresa selecionada!',
            'dados' => array()
        );
    }

    echo json_encode($dados);
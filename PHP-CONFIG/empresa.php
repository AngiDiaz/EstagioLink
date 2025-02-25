<?php
include 'banco.php';
    $id = $_POST['id_usuario'];
    $descricao = $_POST['descricao-emp'];
    $telefone = $_POST['tel'];
    $email = $_POST['emailcontato'];
    $curso = $_POST['curso'];
    $requisito = $_POST['requisitos'];
    $resp = $_POST['responsabilidades'];
    $oferta = $_POST['oferta'];

    cadastrarDadosEmpresa($id, $descricao, $telefone, $email, $curso, $requisito, $resp, $oferta);

?>
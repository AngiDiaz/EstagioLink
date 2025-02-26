<?php
    include 'banco.php';
    $id_usuario = $_COOKIE['id_usuario'];
    $comentario = $_POST['comentario'];
    $nota = $_POST['nota'];
    $empresa = $_POST['empresa'];
    $anonimo = $_POST['anonimo'];


    comentar($id_usuario, $comentario, $nota, $empresa, $anonimo);

?>
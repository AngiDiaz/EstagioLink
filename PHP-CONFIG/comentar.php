<?php
    $id_usuario = $_COOKIE['id_usuario'];
    $comentario = $_POST['comentario'];
    $nota = $_POST['nota'];
    $empresa = filter_input(INPUT_GET,'id_usuario',FILTER_SANITIZE_NUMBER_INT);;


    comentar($id_usuario, $comentario, $nota, $empresa);

?>
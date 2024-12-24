<?php
    $id_usuario = $_POST['codigo'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
  
    include 'funcoes-banco.php';
    atualizar_usuario($id_usuario, $nome, $email);
?>
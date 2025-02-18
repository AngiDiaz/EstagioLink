<?php 
    header("Access-Control-Allow-Origin: *");
    include 'banco.php';
    $id_usuario = $_COOKIE['id_usuario'];
    $result = get_usuario($id_usuario);
    $linha = $result[0];
    include '../raiz.php';
    if (isset($_COOKIE['id_usuario'])) {
    echo 'http://localhost/EstagioLink-1/IMAGENS/'.$linha['foto'].'|'.$linha['nome'];
    } else {
        echo "http://localhost/EstagioLink-1/IMAGENS/foto-perfil.png|Usuário"; // Retorna uma imagem padrão se o cookie não existir
    }  
?>
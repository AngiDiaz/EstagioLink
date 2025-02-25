<?php 
    header("Access-Control-Allow-Origin: *");
    include 'banco.php';
    $id_usuario = $_COOKIE['id_usuario'];
    $result = get_usuario($id_usuario);
    $linha = $result[0];
    if (isset($_COOKIE['id_usuario'])) {
    
        if(!empty($linha['foto'])){
            echo 'http://localhost/EstagioLink/IMAGENS/'.$linha['foto'].'|'.$linha['nome'];
        }else{
            echo 'http://localhost/EstagioLink/IMAGENS/foto-perfil.png'.'|'.$linha['nome'];
        }
    } else {
        echo "http://localhost/EstagioLink/IMAGENS/foto-perfil.png|Usuário"; // Retorna uma imagem padrão se o cookie não existir
    }  
?>
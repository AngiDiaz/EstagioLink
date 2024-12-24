<?php
    $nome = $_POST['nome'];
    $matricula = $_POST['matricula'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    header("Location: ../HTML/paginas-formulario/aluno/dados-pessoais.html");
    exit();
?>
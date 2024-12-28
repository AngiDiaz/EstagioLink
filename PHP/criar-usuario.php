<?php
    
include 'conexao-banco.php';
    $nome = $_POST['nome'];
    $matricula = $_POST['matricula'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $tipo = $_POST['tipo'];

    if($tipo==0){
        $conn = conectar();
        $sql = "INSERT INTO  usuario_aluno (nome, email, matricula, senha) VALUES (:NOME,:EMAIL,:MATRICULA,:SENHA)";

        $instrucao = $conn->prepare($sql);

        $instrucao->bindParam(":NOME",$nome);
        $instrucao->bindParam(":EMAIL",$email);
        $instrucao->bindParam(":MATRICULA",$matricula);
        $instrucao->bindParam(":SENHA",$senha);

        $instrucao->execute();
        header("Location: ../HTML/paginas-formulario/aluno/dados-pessoais.html");
        exit();
    }
    else{
        $conn = conectar();
        $sql = "INSERT INTO  usuario_empresa (nome, email, senha) VALUES (:NOME,:EMAIL,:SENHA)";

        $instrucao = $conn->prepare($sql);

        $instrucao->bindParam(":NOME",$nome);
        $instrucao->bindParam(":EMAIL",$email);
        $instrucao->bindParam(":SENHA",$senha);

        $instrucao->execute();
        header("Location: ../HTML/paginas-formulario/aluno/dados-pessoais.html");
        exit();
        header("Location: ../HTML/paginas-formulario/empresa/informacoes-empresa.html");
        exit();
    }
    
?>
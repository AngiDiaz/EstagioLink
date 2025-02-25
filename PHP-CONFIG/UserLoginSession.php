<?php
session_start();
include 'banco.php';
class UserLogin{

  function logar($nome, $email, $senha){
    $conn = conectar();

    $sql = "SELECT * FROM usuario WHERE nome = :NOME AND email = :EMAIL AND senha = :SENHA";
    $instrucao = $conn->prepare($sql);
    $instrucao->bindParam(":NOME",$nome);
    $instrucao->bindParam(":EMAIL",$email);
    $instrucao->bindParam(":SENHA",$senha);
    $instrucao->execute();

    if($instrucao->rowCount() > 0){
      $result = $instrucao->fetchALL(PDO::FETCH_ASSOC);
      $_SESSION['logado'] = $result[0]['id_usuario'];
      //armazena cookie:
       setcookie('id_usuario', $_SESSION['logado'], time()+(86400*30), "/");
      return true;
    }else{
      return false;
    }
  }

  function sair(){
    session_destroy();
    header("Location:../HTML/login.html");
    exit;
  }
}

function verificarSessao(){
  if(!isset($_SESSION['logado'])){
    header("Location:../HTML/main-aluno.html");
  }
}
 ?>

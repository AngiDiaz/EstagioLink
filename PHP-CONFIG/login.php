<?php
  require 'UserLoginSession.php';
  if(!empty($_POST['nome']) && !empty($_POST['senha']) && !empty($_POST['email'])){
    
    $nome = addslashes($_POST['nome']);
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);

    $user = new UserLogin();

    if($user->logar($nome, $email, $senha) == true){
      if(isset($_SESSION['logado'])){
        $id = $_COOKIE['id_usuario'];
        $result = get_usuario($id);
        $linha = $result[0];
        if($linha['tipo']==0){
          if($linha['curriculo']){
            header('Location:../HTML/listar-usuarios.php');
          }else  if(!$linha['curriculo']){
            header('Location:../HTML/paginas-formulario/aluno/dados-pessoais.html');
          }
        }else if($linha['tipo']==1){
          if($linha['dados']){
            header('Location:../HTML/listar-usuarios.php?');
          }else  if(!$linha['dados']){
            header('Location:../HTML/paginas-formulario/empresa/informacoes-empresa.php');
          }
        }
        
        
      }else{
        header('Location:../HTML/login.html');
      }
    }else{
      header('Location:../HTML/login.html');
    }
  }else{
    header('Location:../HTML/login.html');
  }
?>

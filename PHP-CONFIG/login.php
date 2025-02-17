<?php
  require 'UserLoginSession.php';
  if(!empty($_POST['nome']) && !empty($_POST['senha']) && !empty($_POST['email'])){
    
    $nome = addslashes($_POST['nome']);
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);

    $user = new UserLogin();

    if($user->logar($nome, $email, $senha) == true){
      if(isset($_SESSION['logado'])){
        $result = get_usuario($email);
        $linha = $result[0];
        $id = $linha['id_usuario'];
        header('Location:../HTML/lista-empresas.php?id_usuario='.$id.'');
        
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

<?php
//include 'UserLogin.php';

if(!empty($_POST['nome']) && !empty($_POST['senha'])){
  //include 'config.php';
  require 'UserLoginSession.php';

  $nome = addslashes($_POST['nome']);
  $email = addslashes($_POST['email']);
  $senha = addslashes($_POST['senha']);

  $user = new UserLogin();

  if($user->logar($nome, $senha) == true){
    if(isset($_SESSION['logado'])){
      
      header('Location:home.php');
    }else{
  header('Location:index.php');
    }
  }else{
  header('Location:index.php');
  }

}else{
  header('Location:index.php');
}
?>

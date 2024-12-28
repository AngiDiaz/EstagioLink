<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Cadastro</title>
</head>
<body>

   <?php
   echo '<h2>Dados no arquivo formulario.php</h2>';

   $nome = $_POST['nome'];
   $matricula = $_POST['matricula'];
   $email = $_POST['email'];
   $senha = $_POST['senha'];

   $nome = $_POST['nome'];
   $email = $_POST['email'];
   $razao = $_POST['razao'];
   $cnpj = $_POST['cnpj'];
   $endereco = $_POST['endereco'];
   $telefone = $_POST['telefone'];
   $ramo = $_POST['ramo'];
   $senha = $_POST['senha'];


echo 'Nome: '.$nome.'<br>';
echo 'Matricula: '.$matricula.'<br>';
echo 'Email: '.$email.'<br>';



   include 'funcoes_banco.php';
   cadastrar_usuario($nome,$matricula,$email,$senha);
?>
</body>
</html>
<?php
  $id_usuario = $_POST['codigo'];
  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $senha = $_POST['nova_senha']? $_POST['nova_senha']: $_POST['senha'];
  $senha_antiga = $_POST['senha'];
  $valor = $_POST['valor'];
  $tipo = $_POST['tipo'];
  include '../raiz.php';


  $novo_nome_foto = '';

  if(isset($_FILES['foto']) && $_FILES['foto']['error'] == 0){
    $foto_temp = $_FILES['foto']['tmp_name'];
    $extensao = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));

    $nome_arquivo = pathinfo($_FILES['foto']['name'], PATHINFO_FILENAME);
    $nome_arquivo_limpo = preg_replace('/[^a-zA-Z0-9-_]//', '_', $nome_arquivo);
    $novo_nome_foto = uniqid() . '_' . $nome_arquivo_limpo . '.' . $extensao;

    $diretorio = getRaiz() . '\IMAGENS\\';
    $caminho_foto = $diretorio . $novo_nome_foto;

    $fotos_existentes = glob($diretorio . $email . '.*');
    foreach ($fotos_existentes as $foto_antiga) {
      unlink($foto_antiga);
    }

    if(move_uploaded_file($foto_temp, $caminho_foto)){
      echo "Foto enviada com sucesso.<br>";
    }else {
      echo "Erro ao enviar a foto.<br>";
    }

   }else{
     echo "Nenhuma foto enviada.<br>";
     if(isset($_FILES['foto']['error'])){
       echo 'Código de erro: '.$FILES['foto']['error'] . '<br>';
     }
   }


   include 'banco.php';

   $result = get_usuario($id_usuario);
   $linha = $result[0];
   if($linha['senha']==$senha_antiga){
    atualizar_usuario($id_usuario, $email, $senha, $novo_nome_foto);
    header("Location: ../HTML/editar_usuarios.php");
   }else{
   
    
      header("Location: ../HTML/editar_usuarios.php?erro=senha_incorreta");
      exit(); // Encerra a execução do script
   }

   ?>

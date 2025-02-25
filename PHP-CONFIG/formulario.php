<!DOCTYPE html>
<html>
  <head>
  <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EstágioLink</title>
    <link rel="icon" href="../IMAGENS/ELKLogo.png" type="image/x-icon"/>
    <link rel="stylesheet" href="../CSS/style.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  </head>
  <body>

    <?php
      echo '<h2>Dados no arquivo formulario.php</h2>';

        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $tipo = $_POST['tipo'];
        $senha = $_POST['senha'];
        $valor = $_POST['valor'];
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
        if(isset($_FILES['foto'])){
          echo 'Código de erro: '.$FILES['foto']['error'] . '<br>';
        }
        }

        include 'banco.php';
        cadastrar_usuario($tipo, $nome, $email, $senha, $novo_nome_foto, $valor);
        ?>
  </body>
</html>

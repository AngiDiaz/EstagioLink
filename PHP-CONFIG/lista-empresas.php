<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Página Inicial</title>
    <link rel="stylesheet" type="text/css" href="css/principal.css">
    <style>
      .container{
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
      }
      .item{
        text-align: center;
        margin: 10px;
      }
      .item img{
        display: block;
        margin: 0 auto;
      }
      .item a {
        display: block;
        margin: 5px;
      }
    </style>
</head>

<body>
  <h2>Empresas Cadastradas</h2>
  <div class="container">
  <?php
    include 'banco.php';
    include 'UserLoginSession.php';
    verificarSessao();
    $id_usuario = filter_input(INPUT_GET,'id_usuario',FILTER_SANITIZE_NUMBER_INT);
    $result = get_usuario($id_usuario);
    $linha = $result[0];
    $tipo = $linha["tipo"];
    $result = get_usuarios($tipo);

    foreach ($result as $linha){
      echo '<div class="item">';
      echo '<img src= images/'.($linha["foto"] == null ? 'user.jpg' : $linha["foto"]).' width=200 height=200>';
      $id = $linha["id_usuario"];
      echo '<br><br>';
      echo'<a class="btnExcluir" href="excluir_usuario.php?id_usuario='.$id.'">Excluir</a>';
      echo'<a class="btnEditar" href="editar_usuarios.php?id_usuario='.$id.'">Editar</a>';
      echo '<br><br>';
      echo '</div>';


    }
?>
        </div>
        <a class="linkNovo" href="home.php">Voltar</a>
    </body>
</html>

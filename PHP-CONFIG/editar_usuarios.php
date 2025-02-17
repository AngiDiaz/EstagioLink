<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Edição de usuário</title>
    <link rel="stylesheet" type="text/css" href="css/edit.css">
    <link rel="icon" href="../IMAGENS/ELKLogo.png" type="image/x-icon"/>
    <link rel = "stylesheet" type="text/css" href="../CSS/style.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src = "../JS/script.js" type="text/javascript"></script>

</head>

<body>
<header class="py-3 container-fluid flex-wrap align-items-center justify-content-center justify-content-md-between px-4 ">
        <div class ="row align-items-center flex-nowrap">
          <div class ="row flex-shrink-1 align-items-center">
            <div class="fundo-elk-logo">
              <a href="../main-aluno.html" class=" text-decoration-none">
              <img class=" img-fluid"src="../../IMAGENS/EstágioLink.png">
              </a>
            </div>
            
          </div>
          <div class = "col flex-grow d-flex ml-4 justify-content-end">
            <span style = "color:white">Olá [username]</span>
          </div>
    
          <div class=" col-lg-1 col-2 d-flex justify-content-end flex-shrink-12">
            <img class="img-fluid" src = "../../IMAGENS/foto-perfil.png">
          </div>
        </div>
        
      </header>
    <?php
    include 'banco.php';
    include 'UserLoginSession.php';
    verificarSessao();

    $id_usuario = filter_input(INPUT_GET,'id_usuario',FILTER_SANITIZE_NUMBER_INT);
    $result = get_usuario($id_usuario);
    $linha = $result[0];
    ?>

    <h2> Alterar informações do usuário</h2>
    <div>
        <form method="POST" action="editar.php" enctype="multipart/form-data">
            <label for="codigo">Código:</label>
            <input type="text" id="codigo" name="codigo" value="<?php echo $linha['id_usuario'];?>" readonly="true"><br>

            <?php echo $linha['tipo']==0?"Aluno":"Empresa";?>
            <label for="valor"><?php echo $linha['tipo']==0?"Matricula":"CNPJ";?></label>
            <input type="text" id="valor" name="valor" value="<?php echo $linha['valor'];?>" readonly="true"><br>

            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?php echo $linha['nome'];?>"><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $linha['email'];?>"><br>
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" value="<?php echo $linha['senha'];?>"><br>
            <br><br>
            <img id="foto_atual" src="images/<?php echo $linha['foto'];?>" alt="Foto Atual" width="100"><br>

            <input type="file" id="foto" name="foto" accept="image/png, image/jpeg" onchange="previewFoto(event)">
            <br><br>
            <input type="submit" value="Confirma alteração">
        </form>
        <br>
        <a href="home.php">Usuários cadastrados</a>
    </div>

    <footer class="container-fluid p-3 fixed-bottom position-relative mt-5">
        <div class="row align-items-center">
            <div class ="col-2 flex-shrink-1 d-flex">
                <div class="fundo-ifba">
                    <img class=" img-fluid" src="../../IMAGENS/IFBALogo.png"/>
                </div>
            </div>
            <div class="col text-white text-center">
                <span>Copyright © 2024 EstágioLink, All rights reserved</span>
            </div>
        </div>
    </footer>

</body>

</html>

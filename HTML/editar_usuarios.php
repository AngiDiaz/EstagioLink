<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Edição de usuário</title>
    <link rel="icon" href="../IMAGENS/ELKLogo.png" type="image/x-icon"/>
    <link rel = "stylesheet" type="text/css" href="../CSS/style.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src = "../JS/script.js" type="text/javascript"></script>

</head>

<body>
<header class=" py-3 container-fluid flex-wrap align-items-center justify-content-center justify-content-md-between px-4 ">
        <div class ="row align-items-center flex-nowrap">
          <div class ="row flex-shrink-1 align-items-center">
            <div class="fundo-elk-logo">
              <a href="main-aluno.html" class=" text-decoration-none">
              <img class=" img-fluid"src="../IMAGENS/EstágioLink.png">
              </a>
            </div>
            
          </div>
          <div class = "col flex-grow d-flex ml-4 justify-content-end">
          <button type="button" class="btn btn-outline-light mr-3" onclick="window.location.href='editar_usuarios.php'">Editar usuário</button>

            <span id = "nomeUsuario" style = "color:white">Olá [username]</span>
          </div>
    
          <div class=" col-lg-1 col-2 d-flex justify-content-end flex-shrink-12">
            <img id = "fotoUsuario" class="img-fluid" src = "../IMAGENS/foto-perfil.png">
          </div>
        </div>
        
      </header>
      <nav class = " mb-4 p-1 bg-danger navheader d-flex justify-content-center">
        <div>
            <a href="listar-usuarios.php">Voltar</a>
        </div>
        <div>
            <a href="../PHP-CONFIG/logout.php">Sair</a>
        </div>
     </nav>
      <h3 class="mb-4" style="margin-left: 5em">Alterar informações do usuário</h3>
    <?php
    
    include '../PHP-CONFIG/UserLoginSession.php';
    verificarSessao();

    $username = $_COOKIE['id_usuario'];
    $result = get_usuario($username);
    $linha = $result[0];
    
    ?>
    <div class= "container-fluid w-50">
      <?php
        if (isset($_GET['erro'])) {
          $erro = $_GET['erro'];
    
          if ($erro == "senha_incorreta") {

            echo "<div class='alert alert-danger' role='alert'>Senha incorreta. Tente novamente.</div>";
          }
        }
      ?>
      
        <form method="POST" action="../PHP-CONFIG/editar.php" enctype="multipart/form-data">
            <input class = "form-control" type="hidden" id="codigo" name="codigo" value="<?php echo $linha['id_usuario'];?>" readonly="true">
            <label for="valor"><?php echo $linha['tipo']==0?"Matricula":"CNPJ";?></label>
            <input class = "form-control" type="text" id="valor" name="valor" value="<?php echo  $linha['tipo']==0?$linha['matricula']:$linha['cnpj'];?>" readonly="true">
            <input id = "tipo" name = "tipo" type = "hidden" value = "<?php echo $linha['tipo']?>">
            <label for="nome">Nome:</label>
            <input class = "form-control" type="text" id="nome" name="nome" value="<?php echo $linha['nome'];?>" readonly="true">
            <label for="email">Email:</label>
            <input class = "form-control" type="email" id="email" name="email" value="<?php echo $linha['email'];?>">
            <label for="senha">Senha:</label>
            <input class = "form-control" type="password" id="senha" name="senha" required><br>
            <label for="nova_senha">Nova Senha:</label>
            <input class = "form-control" type="password" id="nova_senha" name="nova_senha">
            <br>
            <img id="foto" src="../IMAGENS/<?php echo $linha['foto']? $linha['foto']: "foto-perfil.png";?>" alt="Foto de Perfil" width="100em">

            <input type="file" id="foto" name="foto" accept="image/png, image/jpeg, image/jpg" onchange="previewFoto(event)">
            <br><br>
            <div class ="d-flex justify-content-center"><button class = "btn" type="submit">Salvar</button></div>
        </form>
        <br>

        <button onclick="window.location.href='../PHP-CONFIG/excluir_usuario.php'" class = "btn bg-danger" type="submit">Excluir Conta</button>
    </div>

    <footer class="container-fluid p-3 fixed-bottom position-relative mt-5">
        <div class="row align-items-center">
            <div class ="col-2 flex-shrink-1 d-flex">
                <div class="fundo-ifba">
                    <img class=" img-fluid" src="../IMAGENS/IFBALogo.png"/>
                </div>
            </div>
            <div class="col text-white text-center">
                <span>Copyright © 2024 EstágioLink, All rights reserved</span>
            </div>
        </div>
    </footer>

</body>

</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar dados</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="icon" href="../../IMAGENS/ELKLogo.png" type="image/x-icon"/>
    <link rel="stylesheet" href="../../CSS/style.css">


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
    include 'conexao-banco.php';
    $id_usuario = filter_input(INPUT_GET,'id_usuario',FILTER_SANITIZE_NUMBER_INT);
    $result = get_usuario($id_usuario);
    $linha = $result[0];
    $excluir_usuario = excluir_usuario($id_usuario);
    ?>

    <h2> Alterar informações do usuário</h2>
    <div>
        <form method="POST" action="editar.php">
            <label for="codigo">Código:</label>
            <input type="text" id="codigo" name="codigo" value="<?php echo $linha['id_usuario'];?>" readonly="true"><br>

            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?php echo $linha['nome'];?>"><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $linha['email'];?>"><br>
            <fieldset>
                <legend>Sexo</legend>
                <input type="radio" id="masc" name="sexo"
                <?php
                if($linha['sexo'] === 'Masculino'){
                echo 'checked';
                    }?>
                value="Masculino">
                <label for="masc">Masculino</label><br>
                <input type="radio" id="fem" name="sexo"

                <?php
                if($linha['sexo'] === 'Feminino'){
                echo 'checked';
                    }?>
                value="Feminino">
                <label for="fem">Feminino</label>

            </fieldset>
            <input type="text" id="senha" name="senha" value="<?php echo $linha['senha'];?>"><br>
            <input type="submit" value="Excluir usuario">
            <input type="button" id="excluir" name="excluir" value="<?php echo $excluir_usuario['excluir'];?>"><br>
            <input type="submit" value="Confirma alteração">
        </form>
        <br>
        <a href="index.php">Usuários cadastrados</a>
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

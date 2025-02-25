<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favoritos</title>
    <link rel="icon" href="../../IMAGENS/ELKLogo.png" type="image/x-icon"/>
    <link rel = "stylesheet" type="text/css" href="../../CSS/style.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <?php
        include '../../../PHP-CONFIG/UserLoginSession.php';
        verificarSessao();
        $id_usuario = $_COOKIE['id_usuario'];
        $comentarios = get_comentarios($id_usuario);
        $comentario = $comentarios[0];
        
        
    ?>
    <header class="py-3 container-fluid flex-wrap align-items-center justify-content-center justify-content-md-between px-4 ">
        <div class ="row align-items-center flex-nowrap">
          <div class ="row flex-shrink-1 align-items-center">
            <div class="fundo-elk-logo">
              <a href="main-aluno.html" class=" text-decoration-none">
              <img class=" img-fluid"src="../IMAGENS/EstágioLink.png">
              </a>
            </div>
            
          </div>
          <div class = "col flex-grow d-flex ml-4 justify-content-end">
            <span id = "nomeUsuario" style = "color:white">Olá [username]</span>
          </div>
    
          <div class=" col-lg-1 col-2 d-flex justify-content-end flex-shrink-12">
            <img class="img-fluid" id = "fotoUsuario" src = "../IMAGENS/foto-perfil.png">
          </div>
        </div>
        
      </header>
      <nav class = " mb-4 p-1 bg-danger navheader d-flex justify-content-center">
        <div>
            <a href="../editar-visualizar.php">Minha Empresa</a>
        </div>
        <div>
            <a href="../listar-usuarios">Currículos</a>
        </div>
        <div>
            <a href="">Avaliações</a>
        </div>
     </nav>
    <div class="main-content mb-3 ml-5">
        <nav class="navbar navbar-expand-lg navbar-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Alterna navegação">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" href="main-empresa.html">Home </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="">Avaliações <span class="sr-only">(Página atual)</span></a>
                </li>
              </ul>
            </div>
          </nav>
    </div>
    <h3 class="mb-4" style="margin-left: 5em">Avaliações</h3>
    <h5 class="mb-4" style="margin-left: 10em">
        Avaliação geral:
        <span> 4</span>
            <ion-icon name="star-outline"></ion-icon>
            <ion-icon name="star-outline"></ion-icon>
            <ion-icon name="star-outline"></ion-icon>
            <ion-icon name="star-outline"></ion-icon>
    </h5>
    <?php

        if($comentarios){
            foreach ($comentarios as $comentario){
                $usuario = htmlspecialchars($comentario['id_usuario']);
                $autor = get_usuario($usuario);
                $infos = $autor[0];
                $tempo = tempoDecorrido($comentario['registro']);
                echo '<div class="container-fluid w-75">
                        <div class = "comentario">
                            <div class = "linha ">';
                echo '<div class ="col-1"><img class="img-fluid" src='.htmlspecialchars($infos['foto']).'></div>
                        <span class="col">'.htmlspecialchars($infos['nome']).'</span>
                        <span> 4</span>
                        <div class="col">';
                for($i = 0; $i<4; $i++){
                    echo '<ion-icon name="star-outline"></ion-icon>';
                }
                echo ' </div> </div>';
                echo '<p>'.htmlspecialchars($comentario['comentario']).'</p>
                <span>2 dias atrás.</span>
                 </div>
                <div class ="m-5 botaovisual d-flex justify-content-between align-items-center">
                        <button class = "btn border mb-5">Responder<ion-icon name="send-outline"></ion-icon></button>
                        <button class = "btn border mb-5">Denunciar<ion-icon name="alert-circle-outline"></ion-icon></button>
                    </div>
                </div>';
            }
        }
    ?>
    
          
          
          
       
        
        
     

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
    <script src = "../../JS/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!-- script para os icones -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>
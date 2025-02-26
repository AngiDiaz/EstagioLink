<!DOCTYPE html>
<html>
  <head>
      <meta charset="utf-8" />
      <title>Página Inicial</title>
      <link rel="icon" href="../IMAGENS/ELKLogo.png" type="image/x-icon"/>
      <link rel = "stylesheet" type="text/css" href="../CSS/style.css"/>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">    
  </head>

  <body>
    <?php
      include '../PHP-CONFIG/UserLoginSession.php';
      verificarSessao();
      $id_usuario = $_COOKIE['id_usuario'];
      $result = get_usuario($id_usuario);
      $linha = $result[0];
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
      <button type="button" class="btn btn-outline-light mr-3" onclick="window.location.href='editar_usuarios.php'">Editar usuário</button>
        <span id = "nomeUsuario" style = "color:white">Olá [username]</span>
      </div>

      <div class=" col-lg-1 col-2 d-flex justify-content-end flex-shrink-12">
        <img id="fotoUsuario" class="img-fluid" src = "../IMAGENS/foto-perfil.png">
      </div>
    </div>
          
  </header>
  <nav class = "mb-4 p-1 bg-danger navheader d-flex justify-content-center">
    <div>
        <a href="editar-visualizar.php"><?php echo $linha["tipo"]==0? "Meu Currículo": "Minha Empresa"; ?></a>
    </div>
    <div>
        <a href="">Pesquisar</a>
    </div>
    <?php 
    if($linha["tipo"]==0){
      echo '<div id = "relato">
        <a href="relato-anonimo/relato.html">Relato</a>
    </div>';
    }else{
      echo ' <div>
            <a href="avaliacoes/empresa.php">Avaliações</a>
        </div>';
    }
    ?>
    
    <div>
      <a href="../PHP-CONFIG/logout.php">Sair</a>
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
              <a class="nav-link" href="../main-aluno.html">Home </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="">Pesquisar <span class="sr-only">(Página atual)</span></a>
            </li>
          </ul>
        </div>
      </nav>
  </div>
  <h3 class="mb-4" style="margin-left: 5em"><?php echo $linha["tipo"]==0? "Estágios": "Estagiários"; ?></h3>
    <div class="container-fluid w-50">
    <div class = "d-flex justify-content-between mb-5 align-items-center">
    <input class = "inputformat"  style="width: 25em !important; "type="text" placeholder = "Pesquisar">
    <button class = "btn">Pesquisar</button>
    </div>
    <div class = "row flex-nowrap d-flex justify-content-center">
 
          
  <?php
   
    $usuarios = $linha['tipo'];
    if($usuarios==0){
      $usuarios = 1;
    }else{
      $usuarios = 0;
    }
    $results = get_usuarios($usuarios);
    echo '<div class = "d-flex flex-wrap">';

    if($results){
      foreach ($results as $linha){
      if($linha['curriculo'] || $linha['dados']){echo "<div class = 'col-4 align-self-start justify-content-center p-5'>";
        echo "<div class=' p-2 card overflow-hidden position-relative d-flex justify-content-center align-items-center' style = ' width: 12em;'>";
          echo "<img src= ../IMAGENS/".($linha['foto'] == null ? 'foto-perfil.png' : htmlspecialchars($linha['foto'])). " width=150em height=150em style = 'object-fit: cover'>";
        echo "</div>";
        echo "<div class='d-flex align-items-center justify-content-between' style = ' width: 12em;'>
              <span class='card-title'>".$linha['nome']."</span>
              <div class = 'justify-content-between'>
                <a class = 'text-dark' href='visualizar.php?id_usuario=".htmlspecialchars($linha['id_usuario'])."'><ion-icon name='eye-outline'></ion-icon></a>
                <ion-icon name='call-outline'></ion-icon>
                <ion-icon name='star-outline'></ion-icon>
               </div>
             </div> ";
      echo '</div>';}else{
        echo ' <div class="alert alert-danger" role="alert">'.
          ($linha['tipo']==0? "Nenhum aluno cadastrado.": "Nenhuma empresa cadastrada.")
          .'</div>';
      }
      }
    }else{
      echo ' <div class="alert alert-danger" role="alert">'.
        ($linha['tipo']==1? "Nenhum aluno cadastrado.": "Nenhuma empresa cadastrada.")
        .'</div>';
    }
    
    echo '</div>';
  ?>
      </div>
      </div>  
      </div>
      <footer class="container-fluid p-3 fixed-bottom mt-5 position-relative">
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
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src = "../JS/script.js"></script>
  </body>
</html>

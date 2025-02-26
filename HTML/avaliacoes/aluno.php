<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relato</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="icon" href="../../IMAGENS/ELKLogo.png" type="image/x-icon"/>
    <link rel="stylesheet" href="../../CSS/style.css">
</head>

<body>
  <?php
    include '../../PHP-CONFIG/UserLoginSession.php';
    verificarSessao();
    $empresa = filter_input(INPUT_GET,'id_usuario',FILTER_SANITIZE_NUMBER_INT);
  ?>
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
            <button type="button" class="btn btn-outline-light mr-3" onclick="window.location.href='../editar_usuarios.php'">Editar usuário</button>
            <span id = "nomeUsuario" style = "color:white">Olá [username]</span>
          </div>
    
          <div class=" col-lg-1 col-2 d-flex justify-content-end flex-shrink-12">
            <img id="fotoUsuario" class="img-fluid" src = "../../IMAGENS/foto-perfil.png">
          </div>
        </div>
        
      </header>
    
      <nav class = "mb-4 p-1 bg-danger navheader d-flex justify-content-center">
        <div>
            <a href="../editar-visualizar.php">Meu Cúrriculo</a>
        </div>
        <div>
            <a href="../listar-usuarios.php">Pesquisar</a>
        </div>
        <div>
            <a href="">Relato</a>
        </div>
        <div>
          <a href="../../PHP-CONFIG/logout.php">Sair</a>
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
                  <a class="nav-link" href="../main-aluno.html">Home <span class="sr-only">(Página atual)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pesquisar</a>
                  </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Avaliar</a>
                </li>
              </ul>
            </div>
          </nav>
    </div>
    <h3 class="mb-4" style="margin-left: 5em">Avaliação</h3>
    <div class="container-fluid w-50">

    <div class="alert alert-success" role="alert">
        Asseguramos que todas as informações fornecidas aqui serão tratadas com o mais alto grau de confidencialidade. Seu anonimato é nossa prioridade absoluta.
    </div>
    <form action = "../../PHP-CONFIG/comentar.php" method = "POST">
        <input type = "hidden" value = <?php echo $empresa;?> name = "empresa">
        <div class="form-group">
            <label>Comentário anônimo</label>
            <select name="anonimo" class="inputformat form-control p-2" required>
                <option value="1">Sim</option>
                <option value="0">Não</option>
            </select>
        </div>
        <div class="form-group">
            <label>Em quanto você avalia sua satisfação com o estágio?</label><br>
            <input type="radio" name="nota" value="1" required> <label for="nota">Horrível</label>
            <input type="radio" name="nota" value="2" required> <label for="nota">Ruim</label>
            <input type="radio" name="nota" value="3" required> <label for="nota">Regular</label>
            <input type="radio" name="nota" value="4" required> <label for="nota">Bom</label>
            <input type="radio" name="nota" value="5" required> <label for="nota">Excelente</label>
        </div>
        <div class="form-group">
            <label>Comentário</label>
            <textarea name = "comentario" class = "form-control mb-3" type = "text" placeholder="Escreva sua experiência com o estágio..." required></textarea>
            </div>
            <button class ="btn" type="submit">Enviar</button>
        </div>
        
    </form>
    
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
    <script src = "../../JS/script.js"></script>
</body>
</html>

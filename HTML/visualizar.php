<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar</title>
    <link rel="icon" href="../IMAGENS/ELKLogo.png" type="image/x-icon"/>
    <link rel="stylesheet" type="text/css" href="../CSS/style.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <?php
    include '../PHP-CONFIG/UserLoginSession.php';
    verificarSessao();

    $id = filter_input(INPUT_GET,'id_usuario',FILTER_SANITIZE_NUMBER_INT);
    $result_user = get_usuario($id);
    $usuario = $result_user[0];

    $id_usuario = $_COOKIE['id_usuario'];
    $result_login = get_usuario($id);
    $login = $result_login[0];
    $id_dados = $login['dados'];
    
    $comentarios = get_comentarios($id);
    if($comentarios){
        $comentario = $comentarios[0];
    }
    

    
    ?>

    <header class="py-3 container-fluid flex-wrap align-items-center justify-content-center justify-content-md-between px-4">
        <div class="row align-items-center flex-nowrap">
            <div class="row flex-shrink-1 align-items-center">
                <div class="fundo-elk-logo">
                    <a href="main-aluno.html" class="text-decoration-none">
                        <img class="img-fluid" src="../IMAGENS/EstágioLink.png">
                    </a>
                </div>
            </div>
            <div class="col flex-grow d-flex ml-4 justify-content-end">
            <button type="button" class="btn btn-outline-light mr-3" onclick="window.location.href='editar_usuarios.php'">Editar usuário</button>

                <span id="nomeUsuario" style="color:white">Olá <?php echo htmlspecialchars($login['nome']); ?></span>
            </div>
            <div class="col-lg-1 col-2 d-flex justify-content-end flex-shrink-12">
                
                <img id="fotoUsuario" class="img-fluid" src="../IMAGENS/foto-perfil.png">
            </div>
        </div>
    </header>

    <?php
    echo '<nav class="mb-4 p-1 bg-danger navheader d-flex justify-content-center">
        <div>';
    echo $usuario['tipo'] == 1? "<a href='editar-visualizar.php'>Meu Currículo</a>" : "<a href='editar-visualizar.php'>Minha Empresa</a>";
    echo '</div>
        <div>
            <a href="listar-usuarios.php">Pesquisar</a>
        </div>';
    if ($usuario['tipo'] == 1) {
        echo '<div>
                <a href="relato-anonimo/relato.html">Relato</a>
              </div>';
    }else{
        echo '<div>
            <a href="avaliacoes/empresa.php">Avaliações</a>
        </div>';
    }
    echo '<div>
      <a href="../PHP-CONFIG/logout.php">Sair</a>
    </div></nav>';
    ?>

    <div class="main-content mb-3 ml-5">
        <nav class="navbar navbar-expand-lg navbar-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Alterna navegação">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="main-aluno.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="listar-usuarios.php">Pesquisar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"><?php echo $usuario['tipo'] == 1? "Empresa" : "Currículo"; ?><span class="sr-only">(Página atual)</span></a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <?php
    echo '<h3 style="margin-left: 5em">' . ($usuario['tipo'] == 1 ? "Empresa" : "Currículo") . '</h3>';
    if ($usuario['tipo'] == 1) {
        
        $result_data = get_dados($id_dados);
        $dados = $result_data[0];
        echo '<div class="container-fluid p-5">
            <div class="row flex-nowrap">
                <div class="col px-3 align-items-center d-flex" style="flex-direction: column;">
                    <div border rounded py-5 w-75 mb-3 d-flex justify-content-center align-items-center">
                        <img class="img-fluid" src="../IMAGENS/' . ($usuario['foto'] ? htmlspecialchars($usuario['foto']) : 'ELKLogo.png') . '">
                    </div>
                    <p class="alinhar">' . htmlspecialchars($dados['descricao']) . '</p>
                    <div class="align-items-center d-flex justify-content-between h-25 w-75 botaovisual" style="flex-direction: column;">
                        <button class="btn border">Adicionar aos favoritos<ion-icon name="add-outline"></ion-icon></button>
                        <button class="btn border">Localização<ion-icon class="mr-3" name="map-outline"></ion-icon></button>
                        <button class="btn border">Entrar em contato<ion-icon class="mr-3" name="call-outline"></ion-icon></button>
                        <button class="btn border">Avalie esta empresa<ion-icon class="mr-3" name="star-outline"></ion-icon></button>
                    </div>
                </div>
                <div class="col-8 justify-content-center px-5" style="border-left: solid 0.1em rgba(61, 155, 58, 1);">
                    <div class="alert alert-success" role="alert">
                        <b>' . htmlspecialchars($usuario['nome']) . '</b> está em busca de um estagiário do curso técnico em <b>' . htmlspecialchars($dados['curso_vaga']) . '</b> para integrar a equipe e colaborar em diversos projetos!
                    </div>
                    <p class="bg-danger text-white pl-4" style="border-radius: 3em;">Requisitos</p>
                    <span class="alinhar">' . htmlspecialchars($dados['requisitos']) . '</span>
                    <p class="bg-danger text-white pl-4" style="border-radius: 3em;">Responsabilidades</p>
                    <span class="alinhar">' . htmlspecialchars($dados['responsabilidades']) . '</span>
                    <p class="bg-danger text-white pl-4" style="border-radius: 3em;">Oferta</p>
                    <span class="alinhar">' . htmlspecialchars($dados['beneficios']) . '</span>
                </div>
            </div>
        </div>';
        echo '<button type="button" class="btn mr-3" onclick="window.location.href=\'avaliacoes/aluno.php?id_usuario=' . htmlspecialchars($id) . '\'">Avaliar Empresa</button>';
        echo '<h3>Avaliações dos estagiários </h3>';
            if($comentarios){
                foreach ($comentarios as $comentario){
                    $usuario = htmlspecialchars($comentario['id_usuario']);
                    $autor = get_usuario($usuario);
                    $infos = $autor[0];
                    $tempo = tempoDecorrido($comentario['registro']);
                    echo '
                    <div class="comentariomaior p-2 mx-5">
                        <div class="linha p-2 mb-4 align-items-center">
                            <div class="col-2 p-2">
                                <img class="img-fluid" src="../IMAGENS/' . ($comentario['anonimo'] == 0 ? htmlspecialchars($infos['foto']) : 'foto-perfil.png') . '">
                            </div>
                            <h5 class="col-2 text-left">' . ($comentario['anonimo'] == 0 ? htmlspecialchars($infos['nome']) : "Anônimo") . '</h5>
                            <h5>' . htmlspecialchars($comentario['nota']) . '</h5>
                            <div class="col">';
                
                for ($i = 0; $i < $comentario['nota']; $i++) {
                    echo '<ion-icon name="star-outline"></ion-icon> ';
                }
                
                echo '
                            </div>
                        </div>
                        <span class = "ml-5" style = "overflow-wrap: break-word;">' . htmlspecialchars($comentario['comentario']) . '</span>
                        <span class = "text-center">' . htmlspecialchars($tempo) . '.</span>
                    </div>
                    <div class="mx-5 my-3 botaovisual d-flex justify-content-between align-items-center">
                        <button class="btn border mb-5">Responder<ion-icon name="send-outline"></ion-icon></button>
                        <button class="btn border mb-5">Denunciar<ion-icon name="alert-circle-outline"></ion-icon></button>
                    </div></div>';
                }
            }
    }else{
        echo '<div class="d-flex justify-content-center " style = "height: 50vh;">
            <div class="card p-5 overflow-hidden position-relative d-flex justify-content-center align-items-center" style="width: 18rem;">
                <div class = "p-2 overflow-hidden w-75"><img  width=150em height=150em class="card-img-top img-fluid border"src ="../IMAGENS/'.htmlspecialchars($usuario['foto']).'" alt="Imagem de capa do card"></div>
                <div class="card-body">
                    <h5 class="card-title">'.htmlspecialchars($usuario['nome']).'</h5>
                    
                    <a href="../PDF/'.htmlspecialchars($usuario['curriculo']).'" target="_blank">Ver Currículo</a>
                
                </div>
            </div>
        </div>';
    
    }
    if(!$comentarios){
        if($usuario['tipo'] == 1) {   
        echo ' <div class="alert alert-danger text-center" role="alert">
          Nenhuma avaliação.
          </div>';}
    }
    ?>

    
    <footer class="container-fluid p-3 fixed-bottom position-relative mt-5">
        <div class="row align-items-center">
            <div class="col-2 flex-shrink-1 d-flex">
                <div class="fundo-ifba">
                    <img class="img-fluid" src="../IMAGENS/IFBALogo.png"/>
                </div>
            </div>
            <div class="col text-white text-center">
                <span>Copyright © 2024 EstágioLink, All rights reserved</span>
            </div>
        </div>
    </footer>

    <script src="../JS/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
   
</body>
</html>
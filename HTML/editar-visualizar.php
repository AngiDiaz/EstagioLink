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

    $id_usuario = $_COOKIE['id_usuario'];
    $result = get_usuario($id_usuario);
    $login = $result[0];
    $tipo = $login['tipo'];
    $id_dados = $login['dados'];

    
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
                <span id="nomeUsuario" style="color:white">Olá [username]]</span>
            </div>
            <div class="col-lg-1 col-2 d-flex justify-content-end flex-shrink-12">
                <img id="fotoUsuario" class="img-fluid" src="../IMAGENS/<?php echo $login['foto'] ? $login['foto'] : 'foto-perfil.png'; ?>">
            </div>
        </div>
    </header>

    <?php
    echo '<nav class="mb-4 p-1 bg-danger navheader d-flex justify-content-center">
        <div>';
    echo $tipo == 0? "<a href=''>Meu Currículo</a>" : "<a href=''>Minha Empresa</a>";
    echo '</div>
        <div>
            <a href="listar-usuarios.php">Pesquisar</a>
        </div>';
    if ($tipo == 0) {
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
                        <a class="nav-link"><?php echo $tipo == 1? "Empresa" : "Currículo"; ?> <span class="sr-only">(Página atual)</span></a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <?php
    echo '<h3 style="margin-left: 5em">' . ($tipo== 1 ? "Empresa" : "Currículo") . '</h3>';
    if($login['curriculo'] or $login['dados']){
        if ($tipo == 1) {
            if($login['dados']){

            $result_data = get_dados($id_dados);
            $dados = $result_data[0];
            echo '<div class="container-fluid p-5">
                <div class="row flex-nowrap">
                    <div class="col px-3 align-items-center d-flex" style="flex-direction: column;">
                        <div border rounded py-5 w-75 mb-3 d-flex justify-content-center align-items-center">
                            <img class="img-fluid" src="../IMAGENS/' . ($login['foto'] ? $login['foto'] : 'ELKLogo.png') . '">
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
                            <b>' . htmlspecialchars($login['nome']) . '</b> está em busca de um estagiário do curso técnico em <b>' . htmlspecialchars($dados['curso_vaga']) . '</b> para integrar a equipe e colaborar em diversos projetos!
                        </div>
                        <p class="bg-danger text-white pl-4" style="border-radius: 3em;">Requisitos</p>
                        <span class="alinhar">' . htmlspecialchars($dados['requisitos']) . '</span>
                        <p class="bg-danger text-white pl-4" style="border-radius: 3em;">Responsabilidades</p>
                        <span class="alinhar">' . htmlspecialchars($dados['responsabilidades']) . '</span>
                        <p class="bg-danger text-white pl-4" style="border-radius: 3em;">Oferta</p>
                        <span class="alinhar">' . htmlspecialchars($dados['beneficios']) . '</span>
                    </div>
                    
                </div>
                <div class = "d-flex justify-content-center">
                <button type="button" class="btn mr-3 border" onclick="window.location.href=\'paginas-formulario/empresa/informacoes-empresa.php\'">Editar Informações<ion-icon name="create-outline"></ion-icon></button></div>  
            </div>';}
        }else{
        echo '<div class="d-flex justify-content-center " style = "height: 50vh;">
        <div class="card p-5 overflow-hidden position-relative d-flex justify-content-center align-items-center" style="width: 18rem;">
            <div class = "p-2 overflow-hidden w-75"><img  width=150em height=150em class="card-img-top img-fluid border"src ="../IMAGENS/'.htmlspecialchars($login['foto']).'" alt="Imagem de capa do card"></div>
            <div class="card-body">';
                echo '<div class="card-body">
                    <h5 class="card-title">'.$login['nome'].'</h5>
                    
                    <a href="../PDF/'.$login['curriculo'].'" target="_blank">Ver Currículo</a>
                </div>
                </div>
            </div>
        </div>';
    
    }}else{
        $tipo == 0?header("Location: paginas-formulario/aluno/dados-pessoais.html"): header("Location: paginas-formulario/empresa/informacoes-empresa.php");
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
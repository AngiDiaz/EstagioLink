<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informações da empresa</title>
    <link rel="icon" href="../../../IMAGENS/ELKLogo.png" type="image/x-icon"/>
    <link rel = "stylesheet" type="text/css" href="../../../CSS/style.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

</head>

<body>
<?php
  include '../../../PHP-CONFIG/UserLoginSession.php';
  verificarSessao();
  $id = $_COOKIE['id_usuario'];
  $result = get_usuario($id);
  $empresa = $result[0];
  $id_dados = htmlspecialchars($empresa['dados']);
  $results = get_dados($id_dados);
  if($results){
    $dados = $results[0];
  }
  
  ?>
    <header class="py-3 container-fluid flex-wrap align-items-center justify-content-center justify-content-md-between px-4 ">
        <div class ="row align-items-center flex-nowrap">
          <div class ="row flex-shrink-1 align-items-center">
            <div class="fundo-elk-logo">
              <a href="../../main-aluno.html" class=" text-decoration-none">
              <img class=" img-fluid"src="../../../IMAGENS/EstágioLink.png">
              </a>
            </div>
            
          </div>
          <div class = "col flex-grow d-flex ml-4 justify-content-end">
            <span id = "nomeUsuario" style = "color:white">Olá [username]</span>
          </div>
    
          <div class=" col-lg-1 col-2 d-flex justify-content-end flex-shrink-12">
            <img id = "fotoUsuario" class="img-fluid" src = "../../../IMAGENS/foto-perfil.png">
          </div>
        </div>
        
      </header>
      <nav class = " mb-4 p-1 bg-danger navheader d-flex justify-content-center">
        <div>
            <a href="../../../PHP-CONFIG/logout.php">Sair</a>
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
                  <a class="nav-link" href="../../main-aluno.html">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href=<?php echo $empresa['dados']?"../../visualizar.php":"";?>>Minha Empresa</a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="">Informações da empresa <span class="sr-only">(Página atual)</span></a>
                </li>
              </ul>
            </div>
          </nav>
    </div>
    <h3 class="mb-4" style="margin-left: 5em">Informações da Empresa</h3>
    <div class="container-fluid w-50">
        
        <form  action=<?php echo $empresa['dados']? "../../../PHP-CONFIG/atualizar-empresa.php": "../../../PHP-CONFIG/empresa.php"?> method="POST">
            <input type="hidden" value ="<?php echo htmlspecialchars($id);?>" name="id_usuario">
            <?php
            if($empresa['dados']){
              echo '<input type="hidden" value ='.htmlspecialchars($dados['id_dados']).' name="id_dados">';
            }
            ?>
            <div class="border-bottom mb-3">
            </div>
            <h3>Informações da empresa</h3>
            <div class="form-group">
                <label>Descrição da empresa</label>
                <textarea type="text" class="form-control" name="descricao-emp"  placeholder="Fale um pouco sobre sua empresa" maxlength="255"> <?php echo $empresa['dados']? htmlspecialchars($dados['descricao']):"";?></textarea>
            </div>
            <div class="form-group">
                <label>CEP</label>
                <input type="text" class="form-control" name="cep" class="form-control" placeholder="Ex: xxxxx-xxx" value = <?php echo $empresa['dados']? htmlspecialchars($dados['cep']):"";?>>
            </div>
            <div class="form-group">
                <label>Telefone para contato</label>
                <input type="tel" class="form-control" name="tel" class="form-control" placeholder="Ex: (xx) x xxxx-xxxx" value = <?php echo $empresa['dados']? htmlspecialchars($dados['telefone']):"";?>>
            </div>
            <div class="form-group">
                <label>Email para contato</label>
                <input type="email" class="form-control"required name="emailcontato" class="form-control" placeholder="Ex: example@gmail.com" value = <?php echo $empresa['dados']? htmlspecialchars($dados['email_contato']):"";?> >
            </div>
            <div class="border-bottom mb-3">
            </div>
            <h3>Informações da vaga</h3>
            <div class="form-group">
                <label>Curso do estagiário</label>
                <input type="text" class="form-control" name="curso"  placeholder="Ex: Informática, Alimentos, Edificações" value = <?php echo $empresa['dados']? htmlspecialchars($dados['curso_vaga']):"";?>>
            </div>
           
            <div class="form-group">
                <label>Requisitos</label>
                <textarea type="text" class="form-control" name="requisitos"  placeholder="Conhecimento requerido para o estágio"> <?php echo $empresa['dados']? htmlspecialchars($dados['requisitos']):"";?></textarea>
            </div>
            <div class="form-group">
                <label>Responsabilidades</label>
                <textarea type="text" class="form-control" name="responsabilidades" class="form-control" placeholder="Atividades do estágio"><?php echo $empresa['dados']? htmlspecialchars($dados['responsabilidades']):"";?></textarea>
            </div>
            <div class="form-group">
                <label>Oferta</label>
                <textarea type="text" class="form-control" name="oferta"  placeholder="Bolsas, Auxilios e benefícios da empresa (ex: sala de descanso)"><?php echo $empresa['dados']? htmlspecialchars($dados['beneficios']):"";?></textarea>
            </div>

              
            
            
            <button type="submit" class="btn ">Próximo</button>
          </form>
    </div>

    <footer class="container-fluid p-3 fixed-bottom position-relative mt-5">
        <div class="row align-items-center">
            <div class ="col-2 flex-shrink-1 d-flex">
                <div class="fundo-ifba">
                    <img class=" img-fluid" src="../../../IMAGENS/IFBALogo.png"/>
                </div>
            </div>
            <div class="col text-white text-center">
                <span>Copyright © 2024 EstágioLink, All rights reserved</span>
            </div>
        </div>
    </footer>
    <script src = "../../../JS/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>
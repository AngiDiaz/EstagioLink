<?php
include 'config.php';

/**a variável valor pode ser tanto cnpj quanto matricula dependendo do tipo de usuário */
function cadastrar_usuario($tipo, $nome, $email, $senha, $foto, $valor)
{
    $conn = conectar();
    if($tipo == 0){
      $sql = "INSERT INTO  usuario (nome, email, matricula, senha, foto, tipo) VALUES (:NOME,:EMAIL,:MATRICULA,:SENHA, :FOTO, :TIPO)";
      $instrucao = $conn->prepare($sql);

      $instrucao->bindParam(":NOME",$nome);
      $instrucao->bindParam(":EMAIL",$email);
      $instrucao->bindParam(":MATRICULA",$valor);
      $instrucao->bindParam(":SENHA",$senha);
      $instrucao->bindParam(":FOTO", $foto);
      $instrucao->bindParam(":TIPO", $tipo);
      $instrucao->execute();
    }else if($tipo == 1){
      $sql = "INSERT INTO  usuario (nome, email, cnpj, senha, foto, tipo) VALUES (:NOME,:EMAIL,:CNPJ,:SENHA, :FOTO, :TIPO)";
      $instrucao = $conn->prepare($sql);

      $instrucao->bindParam(":NOME",$nome);
      $instrucao->bindParam(":EMAIL",$email);
      $instrucao->bindParam(":CNPJ",$valor);
      $instrucao->bindParam(":SENHA",$senha);
      $instrucao->bindParam(":FOTO", $foto);
      $instrucao->bindParam(":TIPO", $tipo);
      $instrucao->execute();
      
    }
    header('Location:../HTML/login.html');

    
}

function atualizar_usuario($id_usuario, $email, $senha, $foto = NULL)
{
  $conn = conectar();
    if($foto){
      $sql = 'UPDATE usuario SET email = :EMAIL, senha = :SENHA, foto = :FOTO
      WHERE id_usuario=:ID_USUARIO';
      $instrucao = $conn->prepare($sql);
      $instrucao->bindParam(":ID_USUARIO",$id_usuario);
      $instrucao->bindParam(":EMAIL",$email);
      $instrucao->bindParam(":SENHA",$senha);
      $instrucao->bindParam(":FOTO", $foto);
      $instrucao->execute();
    }else{
      $sql = 'UPDATE usuario SET email = :EMAIL, senha = :SENHA
      WHERE id_usuario=:ID_USUARIO';
      $instrucao = $conn->prepare($sql);
      $instrucao->bindParam(":ID_USUARIO",$id_usuario);
      $instrucao->bindParam(":EMAIL",$email);
      $instrucao->bindParam(":SENHA",$senha);
      $instrucao->execute();
    }
}

function get_usuarios($tipo){
    $conn = conectar();
    $sql = "SELECT * FROM usuario WHERE tipo = :TIPO ORDER BY nome";
    $instrucao = $conn->prepare($sql);
    $instrucao->bindParam(":TIPO", $tipo);
    $instrucao->execute();

    $result = $instrucao->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function get_usuario($id_usuario)
{
  $conn = conectar();
  $sql = "SELECT * FROM usuario WHERE id_usuario = :ID_USUARIO";
  $instrucao = $conn->prepare($sql);
  $instrucao->bindParam(":ID_USUARIO",$id_usuario);

  $instrucao->execute();
  $result = $instrucao->fetchALL(PDO::FETCH_ASSOC);
  return $result;
}

function  excluir_usuario($id_usuario){
    $conn = conectar();
    $sql = "DELETE FROM usuario WHERE id_usuario = :ID_USUARIO";
    $instrucao = $conn->prepare($sql);
    $instrucao->bindParam(":ID_USUARIO",$id_usuario);
    $retorno = $instrucao->execute();
    if($retorno){
        header('Location:home.php');
    }
    else{
        echo "Erro ao pagar o usuário de id = ".$id_usuario;
    }
}

function cadastrarDadosEmpresa($id_usuario, $descricao, $telefone, $email_contato, $curso_vaga, $requisitos, $responsabilidades, $beneficios) {
  $conn = conectar();

  $sql = "INSERT INTO dadosempresa (descricao, telefone, email_contato, curso_vaga, requisitos, responsabilidades, beneficios) 
          VALUES (:DESCRICAO, :TELEFONE, :EMAIL_CONTATO, :CURSO_VAGA, :REQUISITOS, :RESPONSABILIDADES, :BENEFICIOS)";
  $instrucao = $conn->prepare($sql);
  $instrucao->bindParam(":DESCRICAO", $descricao);
  $instrucao->bindParam(":TELEFONE", $telefone);
  $instrucao->bindParam(":EMAIL_CONTATO", $email_contato);
  $instrucao->bindParam(":CURSO_VAGA", $curso_vaga);
  $instrucao->bindParam(":REQUISITOS", $requisitos);
  $instrucao->bindParam(":RESPONSABILIDADES", $responsabilidades);
  $instrucao->bindParam(":BENEFICIOS", $beneficios);
  $instrucao->execute();

  // Recuperar o ID gerado automaticamente
  $id_dados = $conn->lastInsertId();

  associarDados($id_usuario, $id_dados);
}
function associarDados($id_usuario, $id_dados) {
  $conn = conectar();

  $sql = "UPDATE usuario SET dados = :ID_DADOS WHERE id_usuario = :ID_USUARIO";
  $instrucao = $conn->prepare($sql);
  $instrucao->bindParam(":ID_DADOS", $id_dados);
  $instrucao->bindParam(":ID_USUARIO", $id_usuario);
  $instrucao->execute();

  header('Location: ../HTML/listar-usuarios.php');
}

function atualizarDadosEmpresa($id_dados, $descricao, $telefone, $email_contato, $curso_vaga, $requisitos, $responsabilidades, $beneficios) {
  $conn = conectar();

  $sql = "UPDATE dadosempresa 
          SET descricao = :DESCRICAO, 
              telefone = :TELEFONE, 
              email_contato = :EMAIL_CONTATO, 
              curso_vaga = :CURSO_VAGA, 
              requisitos = :REQUISITOS, 
              responsabilidades = :RESPONSABILIDADES, 
              beneficios = :BENEFICIOS 
          WHERE id_dados = :ID_DADOS";
  $instrucao = $conn->prepare($sql);
  $instrucao->bindParam(":ID_DADOS", $id_dados);
  $instrucao->bindParam(":DESCRICAO", $descricao);
  $instrucao->bindParam(":TELEFONE", $telefone);
  $instrucao->bindParam(":EMAIL_CONTATO", $email_contato);
  $instrucao->bindParam(":CURSO_VAGA", $curso_vaga);
  $instrucao->bindParam(":REQUISITOS", $requisitos);
  $instrucao->bindParam(":RESPONSABILIDADES", $responsabilidades);
  $instrucao->bindParam(":BENEFICIOS", $beneficios);
  $instrucao->execute();

  header('Location: ../HTML/listar-usuarios.php');
}

function get_dados($id_dados) {
  $conn = conectar();

  $sql = "SELECT * FROM dadosempresa WHERE id_dados = :ID_DADOS";
  $instrucao = $conn->prepare($sql);
  $instrucao->bindParam(":ID_DADOS", $id_dados);
  $instrucao->execute();

  $result = $instrucao->fetchAll(PDO::FETCH_ASSOC);
  return $result;
}

function addCurriculo($pdf, $id){
  $conn = conectar();
  $sql = 'UPDATE usuario SET curriculo = :CURRICULO WHERE id_usuario=:ID_USUARIO';
  $instrucao = $conn->prepare($sql);

  $instrucao->bindParam(":CURRICULO",$pdf);
  $instrucao->bindParam(":ID_USUARIO", $id);

  $instrucao->execute();
}

function comentar($id, $comentario, $nota, $empresa, $anonimo){
  $conn = conectar();
  $sql = "INSERT INTO comentarios(comentario, nota, id_usuario, empresa, anonimo) VALUES (:COMENTARIO, :NOTA, :ID_USUARIO, :EMPRESA, :ANONIMO)";
  $instrucao = $conn->prepare($sql);
  $instrucao->bindParam(":COMENTARIO", $comentario);
  $instrucao->bindParam(":NOTA",$nota);
  $instrucao->bindParam(":ID_USUARIO", $id);
  $instrucao->bindParam(":EMPRESA",$empresa);
  $instrucao->bindParam(":ANONIMO",$anonimo);


  $instrucao->execute();
  header("Location: ../HTML/listar-usuarios.php");
}
function get_comentarios($empresa){
  $conn = conectar();

  $sql = "SELECT * FROM comentarios WHERE empresa = :EMPRESA";
  $instrucao = $conn->prepare($sql);
  $instrucao->bindParam(":EMPRESA", $empresa);
  $instrucao->execute();

  $result = $instrucao->fetchAll(PDO::FETCH_ASSOC);
  return $result;
}
function tempoDecorrido($timestamp) {
  date_default_timezone_set('America/Sao_Paulo'); 

  $agora = new DateTime(); 
  $comentario = new DateTime($timestamp); 

  $diferenca = $agora->diff($comentario);

  if ($diferenca->y > 0) {
      return $diferenca->y == 1 ? '1 ano atrás' : $diferenca->y . ' anos atrás';
  } elseif ($diferenca->m > 0) {
      return $diferenca->m == 1 ? '1 mês atrás' : $diferenca->m . ' meses atrás';
  } elseif ($diferenca->d > 0) {
      return $diferenca->d == 1 ? '1 dia atrás' : $diferenca->d . ' dias atrás';
  } elseif ($diferenca->h > 0) {
      return $diferenca->h == 1 ? '1 hora atrás' : $diferenca->h . ' horas atrás';
  } elseif ($diferenca->i > 0) {
      return $diferenca->i == 1 ? '1 minuto atrás' : $diferenca->i . ' minutos atrás';
  } else {
      return $diferenca->s == 1 ? '1 segundo atrás' : $diferenca->s . ' segundos atrás';
  }
}
?>

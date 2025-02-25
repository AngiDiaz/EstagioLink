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

function cadastrarDadosEmpresa($id, $descricao, $telefone, $email, $curso, $requisito, $resp, $oferta){
  $conn = conectar();
  $sql = "INSERT INTO dadosempresa(id_empresa, descricao, telefone, email, curso, requisitos, responsabilidades, ofertas) VALUES(:ID, :DESCRICAO, :TEL, :EMAIL, :CURSO, :REQ, :RESP, :OFERTA)";
  $instrucao = $conn->prepare($sql);
  $instrucao->bindParam(":ID", $id);
  $instrucao->bindParam(":DESCRICAO", $descricao);
  $instrucao->bindParam(":TEL", $telefone);
  $instrucao->bindParam(":EMAIL", $email);
  $instrucao->bindParam(":CURSO", $curso);
  $instrucao->bindParam(":REQ", $requisito);
  $instrucao->bindParam(":RESP", $resp);
  $instrucao->bindParam(":OFERTA", $oferta);
  $instrucao->execute();
  $result = get_dados($id);
  $linha = $result[0];
  $id_dados = $linha['id_dados'];
  associarDados($id, $id_dados);
}

function associarDados($id, $id_dados){
  $conn = conectar();
  $sql = 'UPDATE usuario SET dados = :ID_DADOS
      WHERE id_usuario=:ID_USUARIO';
  $instrucao = $conn->prepare($sql);
  $instrucao->bindParam(":ID_USUARIO", $id);
  $instrucao->bindParam(":ID_DADOS", $id_dados);
  $instrucao->execute();

  
}

function atualizarDadosEmpresa($id, $descricao, $telefone, $email, $curso, $requisito, $resp, $oferta){
  $conn = conectar();
  $sql = "UPDATE dadosempresa SET id_empresa = :ID, descricao = :DESCRICAO, telefone = :TEL, email = :EMAIL, curso = :CURSO, requisitos = :REQ, responsabilidades = :RESP, ofertas = :OFERTA)
  WHERE id_empresa=:ID";
  $instrucao = $conn->prepare($sql);
  $instrucao->bindParam(":ID", $id);
  $instrucao->bindParam(":DESCRICAO", $descricao);
  $instrucao->bindParam(":TEL", $telefone);
  $instrucao->bindParam(":EMAIL", $email);
  $instrucao->bindParam(":CURSO", $curso);
  $instrucao->bindParam(":REQ", $requisito);
  $instrucao->bindParam(":RESP", $resp);
  $instrucao->bindParam(":OFERTA", $oferta);
  $instrucao->execute();
  header('Location:../HTML/listar-usuarios.php');
}


function get_dados($id){
  $conn = conectar();
  $sql = "SELECT * FROM dadosempresa WHERE id_empresa = :ID";
  $instrucao = $conn->prepare($sql);
  $instrucao->bindParam(":ID", $id);
  
  $instrucao->execute();
  $result = $instrucao->fetchALL(PDO::FETCH_ASSOC);
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
?>

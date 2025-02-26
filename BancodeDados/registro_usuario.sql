CREATE DATABASE elk;
USE elk;
CREATE TABLE usuario(
    id_usuario INT PRIMARY KEY AUTO_INCREMENT NOT NULL, 
    nome VARCHAR(100) NOT NULL,                
    email VARCHAR(150) NOT NULL UNIQUE,       
    matricula INT,                    
    cnpj VARCHAR(14),                        
    senha VARCHAR(255) NOT NULL,              
    tipo INT NOT NULL,
    foto VARCHAR(255),
    dados INT,
    curriculo VARCHAR(255),
    FOREIGN KEY(dados) REFERENCES dadosempresa(id_dados)
);
CREATE TABLE dadosempresa(
    id_dados INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    descricao VARCHAR(255),
    cep VARCHAR(8),
    telefone VARCHAR(8),
    email_contato VARCHAR(150) NOT NULL UNIQUE,
    curso_vaga  VARCHAR(255),
    requisitos  TEXT, 
    responsabilidades  TEXT, 
    beneficios  TEXT
);
CREATE TABLE comentarios(
    id_comentario INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    anonimo INT NOT NULL,
    nota INT NOT NULL,
    comentario  TEXT NOT NULL, 
    empresa  INT NOT NULL, 
    id_usuario  INT NOT NULL,
    registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    FOREIGN KEY(id_usuario) REFERENCES usuario(id_usuario)
);
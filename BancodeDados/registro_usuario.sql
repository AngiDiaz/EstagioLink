CREATE DATABASE elk;
USE elk;
CREATE TABLE usuario_aluno(
    id_aluno INT PRIMARY KEY AUTO_INCREMENT NOT NULL, -- Chave primária com incremento automático
    matricula VARCHAR(100) NOT NULL,
    nome VARCHAR(100) NOT NULL,                -- Nome do usuário
    email VARCHAR(150) NOT NULL UNIQUE,        -- Email do usuário (único)
    senha VARCHAR(255) NOT NULL                -- Senha do usuário (criptografada)
);

CREATE TABLE usuario_empresa(
    id_empresa INT PRIMARY KEY AUTO_INCREMENT NOT NULL, -- Chave primária com incremento automático
    nome VARCHAR(100) NOT NULL,                -- Nome do usuário
    email VARCHAR(150) NOT NULL UNIQUE,        -- Email do usuário (único)
    senha VARCHAR(255) NOT NULL                -- Senha do usuário (criptografada)
);
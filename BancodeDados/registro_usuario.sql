CREATE DATABASE elk;
USE elk;
CREATE TABLE usuario(
    id_usuario INT PRIMARY KEY AUTO_INCREMENT NOT NULL, -- Chave primária com incremento automático
    nome VARCHAR(100) NOT NULL,                -- Nome do usuário
    email VARCHAR(150) NOT NULL UNIQUE,        -- Email do usuário (único)
    matricula INT,                    -- Matricula para o aluno
    cnpj INT,                                  -- CNPJ para empresa
    senha VARCHAR(255) NOT NULL,                -- Senha do usuário (criptografada)
    tipo INT NOT NULL,
    foto VARCHAR(255)
);

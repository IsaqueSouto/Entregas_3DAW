CREATE DATABASE IF NOT EXISTS smbel
  DEFAULT CHARACTER SET utf8mb4
  DEFAULT COLLATE utf8mb4_unicode_ci;

USE smbel;

DROP TABLE IF EXISTS profissionais;
DROP TABLE IF EXISTS usuarios;

CREATE TABLE usuarios (
    id        INT AUTO_INCREMENT PRIMARY KEY,
    telefone  VARCHAR(30)  NOT NULL,
    cpf       VARCHAR(30)  NOT NULL,
    email     VARCHAR(150) NOT NULL UNIQUE,
    senha     VARCHAR(255) NOT NULL,
    criado_em DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE profissionais (
    id   VARCHAR(50)  PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    foto VARCHAR(500) NOT NULL
) ENGINE=InnoDB;

INSERT INTO profissionais (id, nome, foto) VALUES
('silvio', 'Silvio', 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=400&h=400&fit=crop'),
('maria',  'Maria',  'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=400&h=400&fit=crop'),
('joao',   'João',   'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=400&h=400&fit=crop'),
('ana',    'Ana',    'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=400&h=400&fit=crop'),
('carlos', 'Carlos', 'https://images.unsplash.com/photo-1504593811423-6dd665756598?w=400&h=400&fit=crop');
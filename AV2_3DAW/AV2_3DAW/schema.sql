CREATE DATABASE IF NOT EXISTS smbel
  DEFAULT CHARACTER SET utf8mb4
  DEFAULT COLLATE utf8mb4_unicode_ci;

USE smbel;

DROP TABLE IF EXISTS agendamentos;
DROP TABLE IF EXISTS profissional_dias;
DROP TABLE IF EXISTS servicos_mensais;
DROP TABLE IF EXISTS profissionais;
DROP TABLE IF EXISTS usuarios;

CREATE TABLE usuarios (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    telefone   VARCHAR(30)  NOT NULL,
    cpf        VARCHAR(30)  NOT NULL,
    email      VARCHAR(150) NOT NULL UNIQUE,
    senha      VARCHAR(255) NOT NULL,
    criado_em  DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE profissionais (
    id    INT AUTO_INCREMENT PRIMARY KEY,
    nome  VARCHAR(100) NOT NULL UNIQUE,
    foto  VARCHAR(500) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE profissional_dias (
    id               INT AUTO_INCREMENT PRIMARY KEY,
    profissional_id  INT          NOT NULL,
    dia              VARCHAR(30)  NOT NULL,
    horario          VARCHAR(30)  NOT NULL,
    servico          VARCHAR(100) NOT NULL,
    CONSTRAINT fk_prof_dias
        FOREIGN KEY (profissional_id) REFERENCES profissionais(id)
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE servicos_mensais (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    dia_semana  VARCHAR(30)  NOT NULL,
    nome        VARCHAR(100) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE agendamentos (
    id               INT AUTO_INCREMENT PRIMARY KEY,
    usuario_email    VARCHAR(150) NOT NULL,
    profissional_id  INT          NULL,
    dia              VARCHAR(30)  NOT NULL,
    servico          VARCHAR(100) NOT NULL,
    horario          VARCHAR(30)  NOT NULL,
    mensal           ENUM('sim','não') NOT NULL DEFAULT 'não',
    forma_pagamento  VARCHAR(20)  NOT NULL,
    data_pagamento   DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_ag_prof
        FOREIGN KEY (profissional_id) REFERENCES profissionais(id)
        ON DELETE SET NULL
) ENGINE=InnoDB;


INSERT INTO profissionais (id, nome, foto) VALUES
(1, 'Silvio', 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=400&h=400&fit=crop'),
(2, 'Maria',  'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=400&h=400&fit=crop'),
(3, 'Julio',  'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?w=400&h=400&fit=crop');

INSERT INTO profissional_dias (profissional_id, dia, horario, servico) VALUES
(1, 'Segunda-Feira', '11:30 - 16:30', 'Barba'),
(1, 'Quarta-Feira',  '11:30 - 16:30', 'Corte Masculino'),
(1, 'Sexta-Feira',   '11:30 - 16:30', 'Barba e Corte'),
(2, 'Segunda-Feira', '11:30 - 16:30', 'Corte de Cabelo'),
(2, 'Quarta-Feira',  '11:30 - 16:30', 'Corte e Lavagem'),
(2, 'Sexta-Feira',   '11:30 - 16:30', 'Lavagem de Cabelo'),
(3, 'Terça-Feira',   '11:30 - 16:30', 'Massagem'),
(3, 'Quinta-Feira',  '11:30 - 16:30', 'Massagem'),
(3, 'Sábado',        '11:30 - 16:30', 'Massagem');

INSERT INTO servicos_mensais (dia_semana, nome) VALUES
('Segunda-Feira', 'Corte de Cabelo'),
('Segunda-Feira', 'Lavagem de Cabelo'),
('Segunda-Feira', 'Pedicure'),

('Terça-Feira', 'Massagem'),
('Terça-Feira', 'Marreta'),
('Terça-Feira', 'Massagem e Marreta'),

('Quarta-Feira', 'Corte de Cabelo'),
('Quarta-Feira', 'Corte e Lavagem de Cabelo'),
('Quarta-Feira', 'Pedicure'),

('Quinta-Feira', 'Massagem'),
('Quinta-Feira', 'Marreta'),

('Sexta-Feira', 'Corte de Cabelo'),
('Sexta-Feira', 'Lavagem de Cabelo'),
('Sexta-Feira', 'Pedicure'),
('Sexta-Feira', 'Massagem'),

('Sábado', 'Pedicure'),
('Sábado', 'Massagem'),
('Sábado', 'Marreta'),
('Sábado', 'Massagem e Marreta');

-- Cria o banco de dados
CREATE DATABASE insumos_agricolas;

-- Usa o banco de dados criado
USE insumos_agricolas;

-- Cria a tabela insumos
CREATE TABLE insumos (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    tipo ENUM('Ração', 'Equipamento', 'Remédio', 'Outros') NOT NULL,
    quantidade INT NOT NULL,
    valor DECIMAL(10, 2) NOT NULL
);
CREATE TABLE insumos_agricolas_backup (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    tipo_material ENUM('Ração', 'Equipamento', 'Remédio', 'Outros') NOT NULL,
    quantidade INT NOT NULL,
    valor DECIMAL(10, 2) NOT NULL,
    operacao VARCHAR(10) NOT NULL,  -- Para registrar o tipo de operação (INSERT)
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

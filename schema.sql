-- Schema para base de dados das vendas
CREATE DATABASE IF NOT EXISTS vendas_db;
USE vendas_db;

CREATE TABLE IF NOT EXISTS vendas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente VARCHAR(100) NOT NULL,
    valor_total DECIMAL(10,2) NOT NULL,
    status ENUM('concluido','pendente','reembolso') DEFAULT 'pendente',
    data_venda DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Dados de exemplo
INSERT INTO vendas (cliente, valor_total, status, data_venda) VALUES
('Maria', 1200.00, 'concluido', '2025-01-15'),
('João', 1900.00, 'concluido', '2025-02-20'),
('Ana', 3000.00, 'pendente',  '2025-03-10'),
('Pedro', 2500.00, 'reembolso', '2025-04-05'),
('Lucas', 3200.00, 'concluido', '2025-05-12'),
('Carla', 4000.00, 'concluido', '2025-06-02');

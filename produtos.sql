-- Criar o banco de dados
CREATE DATABASE IF NOT EXISTS loja;
USE loja;

-- Criar a tabela de produtos
CREATE TABLE IF NOT EXISTS produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    descricao TEXT NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    imagem_principal VARCHAR(255),
    imagem_secundaria VARCHAR(255),
    imagem_terciaria VARCHAR(255)
);

-- Inserir alguns produtos de exemplo
INSERT INTO produtos (titulo, descricao, preco, imagem_principal, imagem_secundaria, imagem_terciaria)
VALUES
('Notebook Gamer Acer Nitro 5',
 'Notebook Gamer com processador Intel i7, 16GB RAM, SSD 512GB, placa de vídeo RTX 3060. Ideal para jogos e produtividade.',
 5899.90,
 'notebook1.jpg', 'notebook2.jpg', 'notebook3.jpg'),

('Smartphone Samsung Galaxy S23',
 'Smartphone de última geração com tela AMOLED 6.8”, 12GB RAM, 256GB de armazenamento e câmera tripla de 200MP.',
 4399.00,
 'galaxy1.jpg', 'galaxy2.jpg', 'galaxy3.jpg'),

('Headset HyperX Cloud II',
 'Headset gamer com som surround 7.1, microfone removível e design confortável para longas sessões de jogo.',
 499.99,
 'headset1.jpg', 'headset2.jpg', 'headset3.jpg');

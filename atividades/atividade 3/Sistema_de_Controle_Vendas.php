<?php

$sql_categorias = "CREATE TABLE IF NOT EXISTS categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL)";

$sql_produtos = "CREATE TABLE IF NOT EXISTS produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    quantidade INT NOT NULL,
    estoque_minimo INT NOT NULL,
    categoria_id INT NOT NULL,
    FOREIGN KEY (categoria_id) REFERENCES categorias(id))";

$sql_vendas = "CREATE TABLE IF NOT EXISTS vendas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    produto_id INT NOT NULL,
    quantidade INT NOT NULL, 
    valor_total DECIMAL(10,2) NOT NULL,
    data_venda DATETIME NOT NULL,
    FOREIGN KEY (produto_id) REFERENCES produtos(id))";

$pdo->exec($sql_categorias);
$pdo->exec($sql_produtos);
$pdo->exec($sql_vendas);

$sql_insert_categorias = "INSERT INTO categorias (nome) VALUES 
    ('Hardware'),
    ('Periféricos'),
    ('Computadores e Notebooks'),
    ('Monitores'),
    ('Redes e Cabos')";

$sql_insert_produtos = "INSERT INTO produtos (nome, preco, quantidade, estoque_minimo, categoria_id) VALUES 
    ('Placa de Vídeo RTX 4060 8GB', 2920.00, 8, 2, 1),
    ('SSD NVMe 1TB Kingston', 420.00, 25, 5, 1),
    ('Memória RAM 16GB DDR4', 280.00, 30, 8, 1),
    ('Mouse Gamer Logitech G203', 149.90, 20, 5, 2),
    ('Teclado Mecânico RGB', 289.90, 15, 4, 2),
    ('Headset HyperX Cloud', 340.00, 12, 3, 2),
    ('Notebook Lenovo IdeaPad i5', 3290.00, 6, 2, 3),
    ('Monitor Gamer 24\" 144Hz', 899.00, 10, 3, 4),
    ('Roteador Wi-Fi 6 Dual Band', 310.00, 14, 4, 5),
    ('Cabo HDMI 2.1 2 Metros', 45.00, 50, 15, 5)";

$pdo->exec($sql_insert_categorias);
$pdo->exec($sql_insert_produtos);

?>
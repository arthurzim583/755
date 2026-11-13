<?php

$sql = "CREATE TABLE IF NOT EXISTS categorias(
        id INT, PRIMARY KEY, AUTO_INCREMENT,
        nome VARCHAR(100), NOT NULL)";

$sql = "CREATE TABLE IF NOT EXISTS produtos(
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(100) NOT NULL,
        preco DECIMAL(10,2) NOT NULL,
        quantidade INT NOT NULL,
        estoque_minimo: INT, NOT NULL)";

$sql = "CREATE TABLE IF NOT EXISTS vendas(
        id: INT, PRIMARY KEY, AUTO_INCREMENT,
        produto_id: INT, FOREIGN KEY,
        quantidade: INT, NOT NULL,
        valor_total: DECIMAL(10,2), NOT NULL,
        data_venda: DATETIME, NOT NULL)";

        





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
<?php
    require_once "../conexao2.php";

$sql = "CREATE TABLE IF NOT EXISTS categorias (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(100) NOT NULL)";
$pdo->exec($sql);

$sql = "CREATE TABLE IF NOT EXISTS produtos (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(100) NOT NULL,
        preco DECIMAL(10,2) NOT NULL,
        quantidade INT NOT NULL,
        estoque_minimo INT NOT NULL DEFAULT 0)";
$pdo->exec($sql);

$sql = "CREATE TABLE IF NOT EXISTS vendas (
        id INT AUTO_INCREMENT PRIMARY KEY,
        produto_id INT NOT NULL,
        quantidade INT NOT NULL,
        valor_total DECIMAL(10,2) NOT NULL,
        data_venda DATETIME NOT NULL,
        FOREIGN KEY (produto_id) REFERENCES produtos(id))";
$pdo->exec($sql);

// Evita erro de variável indefinida enquanto a busca para edição não é feita
$produtoEditar = null;

if (isset($_POST["cadastrar"])) {
    $nome = $_POST["nome"];
    $preco = $_POST["preco"];
    $quantidade = $_POST["quantidade"];

    $sql = "INSERT INTO produtos (nome, preco, quantidade) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $preco, $quantidade]);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
</head>
<body>

    <h1>Cadastrar Produtos</h1>
    <h2>
        <?php
            if ($produtoEditar) {
                echo "Editar produto";
            } else {
                echo "Cadastrar produto";
            }
        ?>
    </h2>

    <form method="POST">
        <?php if ($produtoEditar) { ?>
            <input type="hidden" name="id" value="<?= $produtoEditar['id'] ?>">
        <?php } ?>

        <label>Nome do Produto:</label>
        <input type="text" name="nome" required value="<?= $produtoEditar['nome'] ?? '' ?>">
        <br><br>

        <label>Preço:</label>
        <input type="number" name="preco" step="0.01" min="0" required value="<?= $produtoEditar['preco'] ?? '' ?>">
        <br><br>

        <label>Quantidade:</label>
        <input type="number" name="quantidade" min="0" required value="<?= $produtoEditar['quantidade'] ?? '' ?>">
        <br><br>

        <?php if ($produtoEditar) { ?>
            <button type="submit" name="atualizar">Atualizar Produto</button>
        <?php } else { ?>
            <button type="submit" name="cadastrar">Cadastrar Produto</button>
        <?php } ?>
    </form>
    
</body>
</html>

<?php
require_once "conexao2.php";

$sql = "CREATE TABLE IF NOT EXISTS categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL
) ENGINE=InnoDB";

$pdo->exec($sql);

$sql = "CREATE TABLE IF NOT EXISTS produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    categoria_id INT NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    quantidade INT NOT NULL,
    estoque_minimo INT NOT NULL,
    FOREIGN KEY (categoria_id) REFERENCES categorias(id)
) ENGINE=InnoDB";

$pdo->exec($sql);

$sql = "CREATE TABLE IF NOT EXISTS vendas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    produto_id INT NOT NULL,
    quantidade INT NOT NULL,
    valor_total DECIMAL(10,2) NOT NULL,
    data_venda DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (produto_id) REFERENCES produtos(id)
) ENGINE=InnoDB";

$pdo->exec($sql);

$categorias = [
    "Computadores",
    "Periféricos",
    "Armazenamento",
    "Componentes",
    "Acessórios"
];

foreach ($categorias as $nome) {
    $sql = "INSERT INTO categorias (nome)
            SELECT :nome
            WHERE NOT EXISTS (
                SELECT 1 FROM categorias WHERE nome = :nome_busca
            )";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":nome", $nome);
    $stmt->bindValue(":nome_busca", $nome);
    $stmt->execute();
}

$produtos = [
    ["Notebook Lenovo IdeaPad", 1, 3500.00, 10, 3],
    ["Computador Gamer", 1, 5500.00, 5, 2],
    ["Teclado Mecânico", 2, 150.00, 20, 5],
    ["Mouse Gamer", 2, 89.90, 30, 8],
    ["Monitor Samsung 24", 2, 899.00, 12, 3],
    ["SSD Kingston 480GB", 3, 220.00, 15, 5],
    ["HD Seagate 1TB", 3, 280.00, 8, 3],
    ["Memória RAM 16GB", 4, 350.00, 10, 4],
    ["Placa de Vídeo RTX 4060", 4, 2200.00, 6, 2],
    ["Cabo HDMI 2 metros", 5, 25.00, 40, 10]
];

foreach ($produtos as $produto) {
    $sql = "INSERT INTO produtos (nome, categoria_id, preco, quantidade, estoque_minimo)
            SELECT :nome, :categoria_id, :preco, :quantidade, :estoque_minimo
            WHERE NOT EXISTS (
                SELECT 1 FROM produtos WHERE nome = :nome_busca
            )";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":nome", $produto[0]);
    $stmt->bindValue(":categoria_id", $produto[1]);
    $stmt->bindValue(":preco", $produto[2]);
    $stmt->bindValue(":quantidade", $produto[3]);
    $stmt->bindValue(":estoque_minimo", $produto[4]);
    $stmt->bindValue(":nome_busca", $produto[0]);
    $stmt->execute();
}

$mensagem = "";

if (isset($_GET["cadastro"]) && $_GET["cadastro"] == "sucesso") {
    $mensagem = "Produto cadastrado com sucesso!";
}

if (isset($_POST["cadastrar"])) {
    $nome = trim($_POST["nome"]);
    $categoria_id = $_POST["categoria_id"];
    $preco = $_POST["preco"];
    $quantidade = $_POST["quantidade"];
    $estoque_minimo = $_POST["estoque_minimo"];

    if (
        $nome == "" ||
        strlen($nome) > 150 ||
        !is_numeric($preco) ||
        $preco <= 0 ||
        filter_var($quantidade, FILTER_VALIDATE_INT) === false ||
        $quantidade < 0 ||
        filter_var($estoque_minimo, FILTER_VALIDATE_INT) === false ||
        $estoque_minimo < 0 ||
        filter_var($categoria_id, FILTER_VALIDATE_INT) === false
    ) {
        $mensagem = "Preencha os campos corretamente.";
    } else {
        $sql = "SELECT id FROM categorias WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":id", $categoria_id);
        $stmt->execute();

        if (!$stmt->fetch(PDO::FETCH_ASSOC)) {
            $mensagem = "Selecione uma categoria válida.";
        } else {
            $sql = "INSERT INTO produtos
                    (nome, categoria_id, preco, quantidade, estoque_minimo)
                    VALUES (:nome, :categoria_id, :preco, :quantidade, :estoque_minimo)";

            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":nome", $nome);
            $stmt->bindValue(":categoria_id", $categoria_id);
            $stmt->bindValue(":preco", $preco);
            $stmt->bindValue(":quantidade", $quantidade);
            $stmt->bindValue(":estoque_minimo", $estoque_minimo);
            $stmt->execute();

            header("Location: Sistema_de_Controle_Vendas.php?cadastro=sucesso");
            exit;
        }
    }
}

$sql = "SELECT * FROM categorias ORDER BY nome";
$stmt = $pdo->query($sql);
$categorias_lista = $stmt->fetchAll(PDO::FETCH_ASSOC);

$pesquisa = $_GET["pesquisa"] ?? "";
$categoria_filtro = $_GET["categoria"] ?? "";
$estoque_baixo = $_GET["estoque_baixo"] ?? "";
$ordenacao = $_GET["ordenacao"] ?? "";

$sql = "SELECT produtos.*, categorias.nome AS categoria_nome,
        CASE
            WHEN produtos.quantidade = 0 THEN 'ESGOTADO'
            WHEN produtos.quantidade <= produtos.estoque_minimo THEN 'ESTOQUE BAIXO'
            ELSE 'DISPONÍVEL'
        END AS status_estoque
        FROM produtos
        INNER JOIN categorias ON produtos.categoria_id = categorias.id
        WHERE 1=1";

if ($pesquisa != "") {
    $sql .= " AND produtos.nome LIKE :pesquisa";
}

if (
    filter_var($categoria_filtro, FILTER_VALIDATE_INT) !== false &&
    $categoria_filtro > 0
) {
    $sql .= " AND produtos.categoria_id = :categoria";
}

if ($estoque_baixo == "1") {
    $sql .= " AND produtos.quantidade > 0
              AND produtos.quantidade <= produtos.estoque_minimo";
}

if ($ordenacao == "menor") {
    $sql .= " ORDER BY produtos.preco ASC";
} elseif ($ordenacao == "maior") {
    $sql .= " ORDER BY produtos.preco DESC";
} else {
    $sql .= " ORDER BY produtos.id ASC";
}

$stmt = $pdo->prepare($sql);

if ($pesquisa != "") {
    $stmt->bindValue(":pesquisa", "%" . $pesquisa . "%");
}

if (
    filter_var($categoria_filtro, FILTER_VALIDATE_INT) !== false &&
    $categoria_filtro > 0
) {
    $stmt->bindValue(":categoria", $categoria_filtro);
}

$stmt->execute();

$lista_produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Controle de Vendas</title>
    <link rel="stylesheet" href="css/db1.css">
</head>
<body>

    <h1>Sistema de Controle de Estoque e Vendas</h1>

    <h2>Cadastro de Produtos</h2>

    <?php if ($mensagem != ""): ?>
        <p><?= htmlspecialchars($mensagem) ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Nome do produto:</label>
        <input type="text" name="nome" maxlength="150" required>

        <label>Categoria:</label>
        <select name="categoria_id" required>
            <option value="">Selecione uma categoria</option>
            <?php foreach ($categorias_lista as $categoria): ?>
                <option value="<?= $categoria["id"] ?>">
                    <?= htmlspecialchars($categoria["nome"]) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Preço:</label>
        <input type="number" name="preco" step="0.01" min="0.01" required>

        <label>Quantidade em estoque:</label>
        <input type="number" name="quantidade" min="0" step="1" required>

        <label>Estoque mínimo:</label>
        <input type="number" name="estoque_minimo" min="0" step="1" required>

        <button type="submit" name="cadastrar">Cadastrar Produto</button>
    </form>

    <h2>Pesquisa e Filtros</h2>

    <form method="GET">

        <label>Pesquisar produto pelo nome:</label>
        <input type="text" name="pesquisa"
            value="<?= htmlspecialchars($pesquisa) ?>">

        <label>Filtrar por categoria:</label>
        <select name="categoria">
            <option value="">Todas as categorias</option>

            <?php foreach ($categorias_lista as $categoria): ?>
                <option value="<?= $categoria["id"] ?>"
                    <?= ($categoria_filtro == $categoria["id"]) ? "selected" : "" ?>>
                    <?= htmlspecialchars($categoria["nome"]) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>
            <input type="checkbox" name="estoque_baixo" value="1"
                <?= ($estoque_baixo == "1") ? "checked" : "" ?>>
            Mostrar somente produtos com estoque baixo
        </label>

        <br><br>

        <label>Ordenar por preço:</label>
        <select name="ordenacao">
            <option value="">Ordem padrão</option>
            <option value="menor" <?= ($ordenacao == "menor") ? "selected" : "" ?>>
                Menor preço
            </option>
            <option value="maior" <?= ($ordenacao == "maior") ? "selected" : "" ?>>
                Maior preço
            </option>
        </select>

        <button type="submit">Pesquisar</button>

        <a href="Sistema_de_Controle_Vendas.php">Limpar Filtros</a>

    </form>

    <h2>Produtos Cadastrados</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th>Estoque Mínimo</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($lista_produtos as $produto): ?>
                <tr>
                    <td><?= $produto["id"] ?></td>
                    <td><?= htmlspecialchars($produto["nome"]) ?></td>
                    <td><?= htmlspecialchars($produto["categoria_nome"]) ?></td>
                    <td>R$ <?= number_format($produto["preco"], 2, ",", ".") ?></td>
                    <td><?= $produto["quantidade"] ?></td>
                    <td><?= $produto["estoque_minimo"] ?></td>
                    <td><?= $produto["status_estoque"] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>

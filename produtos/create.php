<?php
require_once '../db.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $categoria_id = $_POST['categoria_id'] ?? null;
    $preco = $_POST['preco'] ?? 0;
    $estoque = $_POST['estoque'] ?? 0;
    $descricao = $_POST['descricao'] ?? '';

    $stmt = $pdo->prepare('INSERT INTO produtos (nome, categoria_id, preco, estoque, descricao) VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$nome, $categoria_id, $preco, $estoque, $descricao]);
    header('Location: read.php');
    exit;
}


$categorias = $pdo->query('SELECT id, nome FROM categorias')->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Produto</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <h1>Cadastrar Produto</h1>
    <form method="post">
        <label>Nome:</label><br>
        <input type="text" name="nome" required><br>
        <label>Categoria:</label><br>
        <select name="categoria_id" required>
            <option value="">Selecione</option>
            <?php foreach ($categorias as $cat): ?>
                <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['nome']) ?></option>
            <?php endforeach; ?>
        </select><br>
        <label>Preço:</label><br>
        <input type="number" step="0.01" name="preco" required><br>
        <label>Estoque:</label><br>
        <input type="number" name="estoque" required><br>
        <label>Descrição:</label><br>
        <textarea name="descricao"></textarea><br>
        <input type="submit" value="Cadastrar">
    </form>
    <a href="read.php">Voltar</a>
</div>
</body>
</html>

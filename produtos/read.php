<?php
require_once '../db.php';
$produtos = $pdo->query('SELECT p.*, c.nome as categoria FROM produtos p LEFT JOIN categorias c ON p.categoria_id = c.id')->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Produtos</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <h1>Produtos</h1>
    <a href="create.php"><button>Novo Produto</button></a>
    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Categoria</th>
            <th>Preço</th>
            <th>Estoque</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($produtos as $p): ?>
        <tr>
            <td><?= $p['id'] ?></td>
            <td><?= htmlspecialchars($p['nome']) ?></td>
            <td><?= htmlspecialchars($p['categoria']) ?></td>
            <td>R$ <?= number_format($p['preco'],2,',','.') ?></td>
            <td><?= $p['estoque'] ?></td>
            <td>
                <a href="update.php?id=<?= $p['id'] ?>">Editar</a> |
                <a href="delete.php?id=<?= $p['id'] ?>" onclick="return confirm('Excluir produto?');">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
</body>
</html>

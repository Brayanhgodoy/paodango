<?php
require_once '../db.php';
$categorias = $pdo->query('SELECT * FROM categorias')->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Categorias</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <h1>Categorias</h1>
    <a href="create.php"><button>Nova Categoria</button></a>
    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($categorias as $c): ?>
        <tr>
            <td><?= $c['id'] ?></td>
            <td><?= htmlspecialchars($c['nome']) ?></td>
            <td><?= htmlspecialchars($c['descricao']) ?></td>
            <td>
                <a href="update.php?id=<?= $c['id'] ?>">Editar</a> |
                <a href="delete.php?id=<?= $c['id'] ?>" onclick="return confirm('Excluir categoria?');">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
</body>
</html>
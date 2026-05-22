<?php

require_once 'config/conexao.php';
require_once 'includes/header.php';

$sql = "SELECT * FROM produtos";

$stmt = $conexao->prepare($sql);
$stmt->execute();

$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<h2>Produtos</h2>

<div class="container">

<?php foreach($produtos as $produto): ?>

<div class="card">

    <h3><?= $produto['nome'] ?></h3>

    <p><strong>Fabricante:</strong>
    <?= $produto['fabricante'] ?></p>

    <p><strong>Preço:</strong>
    R$ <?= $produto['preco'] ?></p>

    <p><strong>Estoque:</strong>
    <?= $produto['estoque'] ?></p>

    <a class="btn" href="editar.php?id=<?= $produto['id'] ?>">
        Editar
    </a>

    <a class="btn excluir"
    href="excluir.php?id=<?= $produto['id'] ?>">
        Excluir
    </a>

</div>

<?php endforeach; ?>

</div>

<?php require_once 'includes/footer.php'; ?>